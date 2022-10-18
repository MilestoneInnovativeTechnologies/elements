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
        $cart = $customer = [];
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
        return view('Elements::ordersummary', compact( 'data'));

    }


    public function admin_updateitem(Request $request)
    {
        $id = $request->input('editid');
        $quantity =  $request->input('editquantity');
        $focquantity =  $request->input('editfocquantity');
        $rate = $request->input('editrate');
        $discount =  $request->input('editdiscount');
        $presentcart  = $request->session()->get('cart');
        if($quantity ==0){
            unset($presentcart[$id]);
        }else{
            $presentcart[$id]['quantity'] = $quantity;
            $presentcart[$id]['foc_quantity'] = $focquantity;
            $presentcart[$id]['rate'] = $rate;
            $presentcart[$id]['discount'] = $discount;
        }
        $request->session()->put('cart', $presentcart);
        return redirect()->back()->with('success', 'Cart have updated successfully');
    }




    public function admin_saveorder()
    {

    }

//    public function admin_updateitem(Request $request)
//    {
////        $id = $request->input('editid');
////        $quantity =  $request->input('editquantity');
////        $focquantity =  $request->input('editfocquantity');
////        $rate = $request->input('editrate');
////        $discount =  $request->input('editdiscount');
//        $cart = $request->session()->get('cart');
//        foreach ($cart as $item) {
//            $orderitem = new OrderItem;
//            $orderitem->rate = $item['rate'];
//            $orderitem->quantity = $item['quantity'];
//            $orderitem->discount = $item['discount'];
//            $orderitem->foc_quantity = $item['foc_quantity'];
//            $orderitem->save();
//        }
//        $request->session()->put('cart', $cart);
//        return redirect()->back()->with('success', 'Cart have updated successfully');
//    }




    public function adminorderdisplay($id)
    {
        $data = Order::where('id', $id)->get();
        $data1 = OrderItem::where('order_id', $id)->get();
        return view('Elements::ad_orderdisplaypage', compact( 'data', 'data1'));
    }

}
