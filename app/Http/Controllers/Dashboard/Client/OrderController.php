<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:orders_create'])->only('create');
        $this->middleware(['permission:orders_update'])->only('edit');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);

        return view('dashboard.clients.orders.create', compact('categories', 'client' , 'orders'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {

        $request->validate([
            'products' => 'required|array',
//        'quantities'=>'required|array',
        ]);


        $this->attach_order($request,$client);
        Flasher::addSuccess(trans('messages.success'));
        return redirect()->route('dashboard.orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client, Order $order)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);

        return view('dashboard.clients.orders.edit', compact('client', 'order', 'categories', 'orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client, Order $order)
    {

        $request->validate([
            'products' => 'required|array',
        ]);
        $this->detach_order($order);
        $this->attach_order($request,$client);
        Flasher::addSuccess(trans('messages.Update'));
        return redirect()->route('dashboard.orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order, Client $client)
    {
        //
    }

    private function attach_order($request , $client ){

        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);


        $total_price = 0;
        foreach ($request->products as $id => $quantity) {
            $product = Product::findOrFail($id);

            $total_price += $product->sale_price * $quantity['quantity'];

            $product->update([
                'stock' => $product->stock - $quantity['quantity'],

            ]);
        }


        $order->update([
            'total_price' => $total_price,
        ]);

    }
    private function detach_order($order){
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();

    }
}
