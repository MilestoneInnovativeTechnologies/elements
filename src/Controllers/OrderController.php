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
    public function  store(request $request)
    {
        $request->validate( [
            'payment_mode' => 'required',
            'reference_number' => 'required|max:20',
            'sales_executive' => 'required|max:20',
            'status'=>'required',
            'foctax'=>'required', 'in:Yes,No',

            'credit_period'=>'required',











        ]);
        $orders=new Order();
        $orders->id=$request->id;
        $orders->order_date=$request->order_date;
        $orders->sales_executive=$request->sales_executive;
        $orders->reference_number=$request->reference_number;
        $orders->status=$request->status;
        $orders->foctax=$request->foctax;
        $orders->credit_period=$request->credit_period;
        $orders->save();



//        return back()->with('success','Successfully place order');
    }
}
