<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderhistory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Order/Index',[
            'orders' =>Order::orderBy('status','desc')
            ->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return Inertia::render('Order/Show',[
            'order' =>$order,
            'orderhistories' =>Orderhistory::with('product')
            ->where('order_id', $order->id)
            ->paginate(5)
            ->through(fn ($orderhistory) => [
                'id' => $orderhistory->id,
                'quantity' => $orderhistory->quantity,
                'price' => $orderhistory->price,
                'productname' => $orderhistory->product->name,
                'sku' => $orderhistory->product->sku,
           ]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function changestatus(Request $request, Order $order)
    {
        // pending to completed
        if($order->status===1)
            $order->update(['status' =>2 ]);
        else if($order->status===2) // completed to pending
            $order->update(['status' =>1 ]);
        return Redirect::route('order')->with('success', 'Order Status Change Successful.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
