<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{



    public function __construct()
    {
        $this->middleware(['permission:products_read'])->only('index');
        $this->middleware(['permission:products_create'])->only('create');
        $this->middleware(['permission:products_update'])->only('edit');
        $this->middleware(['permission:products_delete'])->only('destroy');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::when($request->search, function ($q) use ($request) {

            return $q->where(
                'name->' . app()->getLocale(), 'like', '%' . $request->search . '%');
//            orWhere('name->en', 'like', '%' . $request->search . '%');

        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);

        })->latest()->paginate(5);
        $categories = Category::all();


        return view('dashboard.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|unique:products,name->ar',
            'name_en' => 'required|unique:products,name->en',
            'description_ar' => 'required:products,description->ar',
            'description_en' => 'required:products,description->en',
            'category_id' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ]);

        $request_data = $request->except(['name_ar', 'name_en', 'description_en', 'description_ar']);


        if ($request->image) {

            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/products_image/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }

        if ($request->name_ar || $request->name_en) {
            $request_data['name'] = [
                'ar' => $request->name_ar,
                'en' => $request->name_en
            ];

        }
        if ($request->description_ar || $request->description_en) {
            $request_data['description'] = [
                'ar' => $request->description_ar,
                'en' => $request->description_en
            ];

        }


        Product::create($request_data);
        Flasher::addSuccess(trans('messages.success'));
        return redirect()->route('dashboard.products.index');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {


            $request->validate([
                'name_ar' => 'required|unique:products,name->ar' . $product->id,
                'name_en' => 'required|unique:products,name->en' . $product->id,
                'description_ar' => 'required:products,description->ar',
                'description_en' => 'required:products,description->en',
                'category_id' => 'required',
                'purchase_price' => 'required',
                'sale_price' => 'required',
                'stock' => 'required',
            ]);

            $request_data = $request->except(['name_ar', 'name_en', 'description_en', 'description_ar']);


            if ($request->image) {
                if ($product->image != 'default.png') {
                    Storage::disk('public_uploads')->delete('products_image/' . $product->image);

                }


                Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/products_image/' . $request->image->hashName()));

                $request_data['image'] = $request->image->hashName();

            }

            if ($request->name_ar || $request->name_en) {
                $request_data['name'] = [
                    'ar' => $request->name_ar,
                    'en' => $request->name_en
                ];

            }
            if ($request->description_ar || $request->description_en) {
                $request_data['description'] = [
                    'ar' => $request->description_ar,
                    'en' => $request->description_en
                ];

            }
            $product->update($request_data);
            Flasher::addSuccess(trans('messages.Update'));
            return redirect()->route('dashboard.products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        if ($product->image != 'default.png'){
            Storage::disk('public_uploads')->delete('/products_image/' . $product->image);
        }

        $product->delete();
        Flasher::addSuccess(trans('messages.Delete'));
        return redirect()->route('dashboard.products.index');



    }
}
