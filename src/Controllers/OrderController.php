<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;
use Milestone\Elements\Models\Order;

class OrderController extends Controller
{
    public function ordersummary()
    {
        $data = '';
        return view('Elements::ordersummary', compact( 'data'));
    }
    public function cart()
    {

        return view('Elements::ordersummary');
    }
    public function  store(request $request)
    {
        $request->validate( [
            'payment_mode' => 'required',
            'reference_number' => 'required|max:20',
            'sales_executive' => 'required|max:20',
            'status'=>'required',
            'foctax'=>'required',

            'credit_period'=>'required',

        ]);
        $input = $request->all();

        $order = Order::create($input);

//        return back()->with('success', 'order placed successfully.');
//        $order=new Order();
//        $order->id=$request->id;
//        $order->order_date=$request->order_date;
//        $order->sales_executive=$request->sales_executive;
//        $order->customer=$request->customer;
//        $order->reference_number=$request->reference_number;
//        $order->status=$request->status;
//        $order->foctax=$request->foctax;
//        $order->invoice_discount=$request->invoice_discount;
//        $order->credit_period=$request->credit_period;
//        $order->save();
//        return redirect('/ordersummary');
//        return back()->with('success','Successfully place order');
    }
}
