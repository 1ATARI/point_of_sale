<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware(['permission:categories_read'])->only('index');
        $this->middleware(['permission:categories_create'])->only('create');
        $this->middleware(['permission:categories_update'])->only('edit');
        $this->middleware(['permission:categories_delete'])->only('destroy');
    }

    public function index(Request $request)
    {

        $categories = Category::when($request->search, function ($q) use ($request) {
            return $q->where('name->ar', 'like', '%' . $request->search . '%')->orwhere('name->en', 'like', '%' . $request->search . '%');

        })->latest()->paginate(5);


        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
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
            'name_ar' => 'required|unique:categories,name->ar',
            'name_en' => 'required|unique:categories,name->en,'

        ]);

        Category::create([
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en
            ],
        ]);
        Flasher::addSuccess(trans('messages.success'));
        return redirect()->route('dashboard.categories.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_ar' => 'required|unique:categories,name->ar,' . $category->id,
            'name_en' => 'required|unique:categories,name->en,'. $category->id

        ]);
        $category->update([
            'name' => [
                'ar' => $request->name,
                'en' => $request->name_en
            ],
        ]);
        Flasher::addSuccess(trans('messages.Update'));
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Flasher::addSuccess(trans('messages.Delete'));

        return redirect()->route('dashboard.categories.index');
    }
}
