<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;
use Milestone\Elements\Models\Order;
use Milestone\Elements\Models\OrderItem;

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
            'credit_period'=>'required_if:payment_mode,credit',
        ]);
        $order=new Order();
        $order->order_date=$request->order_date;
        $order->sales_executive=1;
        $order->customer=session('customerId');
        $order->reference_number=$request->reference_number;
        $order->payment_mode=$request->payment_mode;
        $order->credit_period=$request->credit_period;
        if($request->foctaxcheck=='on')
        {
            $foc='Yes';

        }
        else{
            $foc='No';
        }
        $order->foctax=$foc;
        $order->invoice_discount=$request->invoice_discount;
        $order->narration=$request->narration;
        $order->save();
        $orderid = $order->id;
        if($orderid){
            $cart = $request->session()->get('cart');
            foreach($cart as $key =>$item){
                $orderitem = new OrderItem;
                $orderitem->order_id = $orderid;
                $orderitem->item =$key;
                $orderitem->rate = $item['rate'];
                $orderitem->quantity = $item['quantity'];
                $orderitem->discount = $item['discount'];
                $orderitem->factor = $item['factor'];
                $orderitem->foc_quantity = $item['foc_quantity'];
                $orderitem->tax_rule = $item['taxrule'];
                $orderitem->tax_percentage = $item['taxpercent'];
                $orderitem->save();
            }
        }
        $request->session()->forget(['cart', 'invoicediscount', 'foc','customerId', 'customername','customer_creditperiod']);
        $request->session()->flash('status', 'Order has saved successfully!');
        return redirect('index');
    }
}


