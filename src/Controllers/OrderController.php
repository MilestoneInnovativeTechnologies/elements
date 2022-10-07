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
        $request->session()->forget(['cart', 'invoicediscount', 'foc','customerId', 'customername','customer_creditperiod']);
        $request->session()->flash('status', 'Order has saved successfully!');
        return redirect('index');
    }
    public function saveitem(Request $request){


        $id = $request->session()->get('id');

        $name = $request->session()->get('name');
        $rate =  $request->session()->get('rate');
        $quantity =  $request->session()->get('quantity');
        $discount =  $request->session()->get('discount');
        $foctax =  $request->session()->get('foc_tax');
        $focquantity =  $request->session()->get('foc_quantity');
        $invoicediscount =  $request->session()->get('invoice_discount');
        $taxrule =  $request->session()->get('tax_rule');
        $taxpercentage =  $request->session()->get('tax_percentage');



    }

    public function orderdisplay($id)
    {
        $data = Order::where('id', $id)->get();
        return view('Elements::orderdisplay', compact( 'data'));
    }

}
