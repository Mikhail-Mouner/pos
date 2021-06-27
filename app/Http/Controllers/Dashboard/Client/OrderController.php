<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
        return $client->orders()->with('products')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        $categories = Category::all();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.form.index',compact(['client','categories','orders']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {
        $this->attach_order($request, $client);

        Session::flash('success',__('message.add'));
        return redirect()->route('dashboard.client.order.create',$client->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client, Order $order)
    {
        $categories = Category::all();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.form.edit.index',compact(['client','categories','orders','order']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client, Order $order)
    {
        $this->detach_order($request, $client,$order);
        $this->attach_order($request, $client);

        Session::flash('success',__('message.edit'));
        return redirect()->route('dashboard.client.order.create',$client->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        foreach ($order->products() as $product){
            $product->update([
                'stock' =>  $product->stock + $product->privot->qty
            ]);
        }
        $order->delete();
        Session::flash('success',__('message.delete'));
        return redirect()->route('dashboard.order.index');
    }

    private function attach_order($request, $client)
    {
        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::FindOrFail($id);
            $total_price += ($product->sale_price * $quantity['qty']);

            $product->update([
                'stock' => $product->stock - $quantity['qty']
            ]);

        }//end of foreach

        $order->update([
            'total_price' => $total_price
        ]);

    }//end of attach order

    private function detach_order($request, $client, $order)
    {

        foreach ($order->products() as $product){

            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }

        $order->delete();

    }//end of attach order

}
