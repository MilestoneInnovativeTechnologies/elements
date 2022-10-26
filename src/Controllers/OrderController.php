<?php

namespace Milestone\Elements\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Milestone\Elements\Models\Customers;
use Milestone\Elements\Models\Order;
use Milestone\Elements\Models\OrderItem;

class OrderController extends Controller
{
    public function neworder(request $request)
    {
        $request->session()->forget(['cart', 'order', 'customer', 'editid', 'old']);
        return redirect()->route('customerlist');
    }
    public function ordersummary(request $request)
    {
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
        if($request->foctaxcheck == 'Yes'){
            $order->foctax=$request->foctaxcheck;
        }else{
            $order->foctax='No';
        }
        $order->invoice_discount=$request->invoice_discount;
        $order->narration=$request->narration;
        if(($total > $maximum_allowed ) && ($payment_mode =='credit')){
            $status = 'Pending';
        }else{
            $status = 'Approved';
            $order->approved_by = auth()->id();
        }
        $order->net_amount = $request->netamt;
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
    public function editorder($id, Request $request)
    {
        $cart = $customer = $orderArr = $old = [];
        $data = Order::where('id', $id)
            ->with(['rcustomer','Items'=>function($query){ $query->with('ritem'); }])->get();
        $array = $data->toArray();
        $customerArr = $array[0]['rcustomer'];
        $items = $array[0]['items'];
        foreach($items as $item) {
            $cart[$item['id']] = [
                "myid" => $item['id'],
                "name" => $item['ritem']['name'],
                "quantity" => $item['quantity'],
                "foc_quantity" => $item['foc_quantity'],
                "minrate" => $item['ritem']['minimum_rate_allowed'],
                "rate" => $item['rate'],
                "factor" => $item['factor'],
                "taxrule" => $item['tax_rule'],
                "taxpercent" => $item['tax_percentage'],
                "discount" => $item['discount'],
            ];
        }
        $request->session()->put('cart', $cart);

        $customer['id'] = $customerArr['id'];
        $customer['name'] = $customerArr['name'];
        $customer['credit_period'] = $customerArr['credit_period'];
        $customer['outstanding'] = $customerArr['outstanding'];
        $customer['maximum_allowed'] = $customerArr['maximum_allowed'];
        $customer['order_total'] = $customerArr['order_total'];
        $request->session()->put('customer', $customer);

        $orderArr['invoicediscount'] = $data[0]['invoice_discount'];
        $orderArr['referencenumber'] = $data[0]['reference_number'];
        $orderArr['creditperiod'] = $data[0]['credit_period'];
        $orderArr['foc'] = $data[0]['foctax'];
        $orderArr['narration'] = $data[0]['narration'];
        $request->session()->put('order', $orderArr);

        $old['oldnetamount'] = $data[0]['net_amount'];
        $request->session()->put('old', $old);

        $request->session()->put('editid', $data[0]['id']);

        return view('Elements::ordersummary');
    }
    public function updateorder(Request $request)
    {
        $request->validate([
            'payment_mode' => 'required|in:cash,credit',
            'credit_period' => 'required_if:payment_mode,credit',
        ]);

        $netamount =$request->netamt;
        $old = $request->session()->get('old');
        $oldnetamount =  $old['oldnetamount'];
        $customer = $request->session()->get('customer');
        $order_total = $customer['order_total'];
        $outstanding = $customer['outstanding'];
        $maximum_allowed = $customer['maximum_allowed'];
        $totalsale = ($order_total - $oldnetamount) +$netamount;
        $total = $totalsale + $outstanding;

        $order = Order::find($request->id);
        $order->customer = $customer['id'];
        $order->reference_number = $request->reference_number;
        $order->payment_mode = $payment_mode = $request->payment_mode;
        $order->credit_period = $request->credit_period;
        $order->order_date = $request->order_date;
        if ($request->foctaxcheck == 'on') {
            $foc = 'Yes';
        } else {
            $foc = 'No';
        }
        $order->foctax = $foc;
        $order->invoice_discount = $request->invoice_discount;
        $order->narration = $request->narration;
        $order->net_amount = $request->netamt;
        if(($total > $maximum_allowed ) && ($payment_mode =='credit')){
            $status = 'Pending';
        }else{
            $status = 'Approved';
            $order->approved_by = auth()->id();
        }
        $order->status = $status;
        $order->updated_by = auth()->id();

        if ($order->save()) {
            $orderid = $order->id;
            $cart = $request->session()->get('cart');
            $OI = [];
            $myid=0;
            foreach ($cart as $key => $item) {
                if(isset($item['myid'])){
                    $myid=$item['myid'];
                }
                if($myid>0){
                    $orderitem = OrderItem::find($myid);
                }else
                {
                    $orderitem = new OrderItem;
                }
                $orderitem->item = $key;
                $orderitem->rate = $item['rate'];
                $orderitem->quantity = $item['quantity'];
                $orderitem->discount = $item['discount'];
                $orderitem->factor = $item['factor'];
                $orderitem->foc_quantity = $item['foc_quantity'];
                $orderitem->tax_rule = $item['taxrule'];
                $orderitem->tax_percentage = $item['taxpercent'];
                $OI[] = $orderitem;
            }
            $order->Items()->saveMany($OI);
            if($payment_mode =='credit') {
                Customers::where('id', $customer)
                    ->update([
                        'order_total' => $totalsale,
                    ]);
            }
        }
        $request->session()->forget(['cart', 'order', 'customer', 'editid']);
        return redirect()->route('index')->with('success', 'Order has been updated successfully');
    }
    public function deleteorder($id)
    {
        $order = Order::where('id', $id)->firstOrFail();
        $order->update(['status' => 'Cancelled', 'cancelled_by' =>  auth()->id(),  'cancelled_at' => Carbon::now()]);
        return redirect()->route('index')->with('success','Order has been cancelled successfully');
    }

    public function orderdisplay($id)
    {
        $data = Order::where('id', $id)->get();
        $data1 = OrderItem::where('order_id', $id)->get();
        return view('Elements::orderdisplay', compact( 'data', 'data1'));
    }

}
