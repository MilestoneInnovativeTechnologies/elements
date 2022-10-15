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
        $discount =  $request->input('editdiscount');
        $oldcart = $request->session()->get('cart');
        if($quantity ==0){
            unset($oldcart[$id]);
        }else{
            $oldcart[$id]['quantity'] = $quantity;
            $oldcart[$id]['foc_quantity'] = $focquantity;
            $oldcart[$id]['discount'] = $discount;
        }
        $request->session()->put('cart', $oldcart);
        return redirect()->back()->with('success', 'Cart have updated successfully');
    }


//    public function  admin_saveorder(request $request)
//    {
//        $netamount = $request->netamt;
//        $customer = $request->session()->get('customer');
//        $outstanding = $customer['outstanding'];
//        $maximum_allowed = $customer['maximum_allowed'];
//        $total = $netamount + $outstanding;
//
//        $order = new Order();
//        $order->order_date = $request->order_date;
//        $order->sales_executive = auth()->id();
//        $order->customer = $customer['id'];
//        $order->reference_number=$request->reference_number;
//        $order->payment_mode=$request->payment_mode;
//        $order->credit_period=$request->credit_period;
//        if($request->foctaxcheck=='on')
//        {
//            $foc='Yes';
//        }
//        else{
//            $foc='No';
//        }
//        $order->foctax=$foc;
//        $order->invoice_discount=$request->invoice_discount;
//        $order->narration=$request->narration;
//        if($total > $maximum_allowed ){
//            $status = 'Pending';
//        }else{
//            $status = 'Approved';
//            $order->approved_by = auth()->id();
//        }
//        $order->status = $status;
//        if($order->save()) {
//            $orderid = $order->id;
//            $cart = $request->session()->get('cart');
//            $OI = [];
//            foreach ($cart as $key => $item) {
//                $orderitem = new OrderItem;
//                $orderitem->item = $key;
//                $orderitem->rate = $item['rate'];
//                $orderitem->quantity = $item['quantity'];
//                $orderitem->discount = $item['discount'];
//                $orderitem->factor = $item['factor'];
//                $orderitem->foc_quantity = $item['foc_quantity'];
//                $orderitem->tax_rule = $item['taxrule'];
//                $orderitem->tax_percentage = $item['taxpercent'];
//                $OI[]=$orderitem;
//            }
//            $order-> Items()->saveMany($OI);
//        }
//        $request->session()->forget(['cart', 'invoicediscount', 'foc', 'referencenumber', 'creditperiod',
//            'customer']);
//        $request->session()->flash('success', 'Order has saved successfully!');
//        return redirect('admin_dashboard/'.$orderid);
//    }
//
//    public function admin_dashboard($id)
//    {
//        $data = Order::where('id', $id)->get();
//        $data1 = OrderItem::where('order_id', $id)->get();
//        return view('Elements::admin_dashboard', compact( 'data', 'data1'));
//    }



}
