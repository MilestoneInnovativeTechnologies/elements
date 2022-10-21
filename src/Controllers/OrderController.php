<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;
use Milestone\Elements\Models\Customers;
use Milestone\Elements\Models\Order;
use Milestone\Elements\Models\OrderItem;

class OrderController extends Controller
{
    public function ordersummary(request $request)
    {
//        $request->session()->forget(['editid']);
        return view('Elements::ordersummary');
    }

    public function  saveorder(request $request)
    {
        $request->validate( [
            'payment_mode' => 'required|in:cash,credit',
            'credit_period'=>'required_if:payment_mode,credit',
        ]);

        $netamount = $request->netamt;
        $customer = $request->session()->get('customer');
        $order_total = $customer['order_total'];
        $outstanding = $customer['outstanding'];
        $maximum_allowed = $customer['maximum_allowed'];
        $totalsale = $netamount + $order_total;
        $total = $totalsale + $outstanding;

        $order = new Order();
        $order->order_date = $request->order_date;
        $order->sales_executive = auth()->id();
        $order->customer = $customer['id'];
        $order->reference_number=$request->reference_number;
        $order->payment_mode = $payment_mode = $request->payment_mode;
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
        if(($total > $maximum_allowed ) && ($payment_mode =='credit')){
            $status = 'Pending';
        }else{
            $status = 'Approved';
            $order->approved_by = auth()->id();
        }
        $order->status = $status;
        if($order->save()) {
            $orderid = $order->id;
            $cart = $request->session()->get('cart');
            $OI = [];
            foreach ($cart as $key => $item) {
                $orderitem = new OrderItem;
                $orderitem->item = $key;
                $orderitem->rate = $item['rate'];
                $orderitem->quantity = $item['quantity'];
                $orderitem->discount = $item['discount'];
                $orderitem->factor = $item['factor'];
                $orderitem->foc_quantity = $item['foc_quantity'];
                $orderitem->tax_rule = $item['taxrule'];
                $orderitem->tax_percentage = $item['taxpercent'];
                $OI[]=$orderitem;
            }
            $order-> Items()->saveMany($OI);
        }
        if($payment_mode =='credit') {
            Customers::where('id', $customer)
                ->update([
                    'order_total' => $totalsale,
                ]);
        }
        $request->session()->forget(['cart', 'order', 'customer']);
        $request->session()->flash('success', 'Order has saved successfully!');
        return redirect('orderdisplay/'.$orderid);
    }

    public function orderdisplay($id)
    {
        $data = Order::where('id', $id)->get();
        $data1 = OrderItem::where('order_id', $id)->get();
        return view('Elements::orderdisplay', compact( 'data', 'data1'));
    }

//    public function adminorderdisplay($id)
//    {
//        $data = Order::where('id', $id)->get();
//        $data1 = OrderItem::where('order_id', $id)->get();
//        return view('Elements::ad_orderdisplaypage', compact( 'data', 'data1'));
//    }

}
