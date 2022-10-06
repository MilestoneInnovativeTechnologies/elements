<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;
use Milestone\Elements\Models\Order;

class OrderController extends Controller
{
    public function ordersummary()
    {
        return view('Elements::ordersummary');
    }

    public function  saveorder(request $request)
    {
        $request->validate( [
            'payment_mode' => 'required|in:cash,credit',
            'reference_number' => 'required|max:20',
            'sales_executive' => 'required|max:20',
            'status'=>'required',
            'foctax'=>'required',
            'credit_period'=>'required_if:payment_mode,credit',
        ]);
//        if (payment_mode == credit) {
//            credit_period=>'required';
//        } else {
//            credit_period=>'nullable';
//        }

        $order=new Order();
        $order->id=$request->id;
        $order->order_date=$request->order_date;
        $order->customer=session('customerId');
        $order->reference_number=$request->reference_number;
        $order->invoice_discount=$request->invoice_discount;
        $order->credit_period=$request->credit_period;

        if($request->foctaxcheck=='on')
        {
            $foc='Yes';

        }
        else{
            $foc='No';
        }
        $order->foctax=$foc;
        $order->sales_executive=1;
        $order->save();
        $request->session()->flush();
        return redirect('index');

    }

}
