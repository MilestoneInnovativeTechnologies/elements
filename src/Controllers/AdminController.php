<?php

namespace Milestone\Elements\Controllers;

use Carbon\Carbon;
use Couchbase\GetAllUsersOptions;
use Illuminate\Http\Request;
use Milestone\Elements\Models\Customers;
use Milestone\Elements\Models\Order;
use Milestone\Elements\Models\OrderItem;


class AdminController extends Controller
{
    public function index()
    {
        $class = 'dashboard';
        $data = Order::where('status', 'Pending')
//            ->orWhere('updated_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('id','DESC')
            ->paginate($this->pageno);
        return view('Elements::admin_dashboard', compact('data', 'class'));
    }



    public function admin_editorder($id, Request $request)
    {
            $cart = $customer = $orderArr = [];
            $data = Order::where('id', $id)->with('rcustomer')->get();
            $array = $data->toArray();
            $customerArr = $array[0]['rcustomer'];
            $data1 = OrderItem::where('order_id', $id)->with('ritem')->get();
            $data1 = $data1->toArray();
            foreach ($data1 as $item) {
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
//        dd($cart);
            $customer['id'] = $customerArr['name'];
            $customer['name'] = $customerArr['name'];
            $customer['credit_period'] = $customerArr['credit_period'];
            $customer['outstanding'] = $customerArr['outstanding'];
            $customer['maximum_allowed'] = $customerArr['maximum_allowed'];
            $request->session()->put('customer', $customer);
            $orderArr['invoicediscount'] = $data[0]['invoice_discount'];
            $orderArr['referencenumber'] = $data[0]['reference_number'];
            $orderArr['creditperiod'] = $data[0]['credit_period'];
            $orderArr['foc'] = $data[0]['foctax'];
            $orderArr['narration'] = $data[0]['narration'];
            $request->session()->put('order', $orderArr);
            $request->session()->put('editid', $data[0]['id']);
//            dd($request->session()->get('editid'));

        return view('Elements::ordersummary', compact('data'));
    }


    public function admin_updateorder(Request $request)
    {
        {
            $request->validate([
                'payment_mode' => 'required|in:cash,credit',
                'credit_period' => 'required_if:payment_mode,credit',
            ]);

            $order = Order::find($request->id);
            $order->reference_number = $request->reference_number;
            $order->payment_mode = $request->payment_mode;
            $order->credit_period = $request->credit_period;
            $order->order_date = $request->order_date;
            if ($request->foctaxcheck == 'Yes') {
                $foc = 'Yes';
            } else {
                $foc = 'No';
            }
            $order->foctax = $foc;
            $order->invoice_discount = $request->invoice_discount;
            $order->narration = $request->narration;
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
            }
            $request->session()->forget(['cart', 'order', 'customer', 'editid']);
            return redirect()->route('adminindex')->with('success', 'Order has been updated successfully');
        }
    }

    public function admin_approve($id)
    {
        $data = Order::where('id', $id)
                ->with(['rcustomer','Items'=>function($query){ $query->with('ritem'); }])->get();
        return view('Elements::approveorder', compact( 'data'));
    }
    public function approval($id)
    {
        $order = Order::find($id);
        $order->status = 'Approved';
        $order->approved_by = auth()->id();
        $order->approved_at = Carbon::now();
        if ($order->save()) {
            return redirect()->route('adminindex')->with('success', 'Order has been approved successfully');
        }
    }
    public function admin_orderhistory()
    {
        $class = 'history';
        $data = Order::orderBy('id','DESC')
            ->paginate($this->pageno);
        return view('Elements::admin_orderhistory', compact( 'data', 'class'));
    }

}
