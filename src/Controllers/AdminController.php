<?php

namespace Milestone\Elements\Controllers;

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
            ->orderBy('id','DESC')
            ->paginate($this->pageno);
        return view('Elements::admin_dashboard', compact( 'data', 'class'));
    }

    public function admin_editorder($id, Request $request)
    {
            $cart = $customer = $orderArr= [];
            $data = Order::where('id', $id)->with('rcustomer')->get();
            $array = $data->toArray();
            $customerArr =$array[0]['rcustomer'];
            $data1 = OrderItem::where('order_id', $id)->with('ritem')->get();
            $data1=$data1->toArray();
            foreach ($data1 as $item) {
                $cart[$item['id']] = [
                    "name" => $item['ritem']['name'],
                    "quantity" => $item['quantity'],
                    "foc_quantity" =>$item['foc_quantity'],
                    "minrate" => $item['ritem']['minimum_rate_allowed'],
                    "rate" => $item['rate'],
                    "factor" => $item['factor'],
                    "taxrule" => $item['tax_rule'],
                    "taxpercent" =>$item['tax_percentage'],
                    "discount" => $item['discount'],
                ];
            }
            $request->session()->put('cart', $cart);
//        dd($cart);
            $customer['id'] = $customerArr['name'];
            $customer['name'] =  $customerArr['name'];
            $customer['credit_period'] = $customerArr['credit_period'];
            $customer['outstanding'] = $customerArr['outstanding'];
            $customer['maximum_allowed'] = $customerArr['maximum_allowed'];
            $request->session()->put('customer', $customer);
            $orderArr['invoicediscount'] = '';
            $orderArr['referencenumber'] = '';
            $orderArr['creditperiod'] = '';
            $orderArr['foc'] = '';
            $request->session()->put('order', $orderArr);

        return view('Elements::ordersummary');
    }










    public function adminorderdisplay($id)
    {
        $data = Order::where('id', $id)->get();
        $data1 = OrderItem::where('order_id', $id)->get();
        return view('Elements::ad_orderdisplaypage', compact( 'data', 'data1'));
    }
    public function admin_orderhistory()
    {
        $class = 'history';
        $data = Order::orderBy('id','DESC')
            ->paginate($this->pageno);
        return view('Elements::admin_orderhistory', compact( 'data', 'class'));
    }



}
