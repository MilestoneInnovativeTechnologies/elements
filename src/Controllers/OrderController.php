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
//    public function cart()
//    {
//
//        return view('Elements::ordersummary');
//    }
    public function  saveorder(request $request)
    {
//        $request->validate( [
//            'payment_mode' => 'required',
//            'reference_number' => 'required|max:20',
//            'sales_executive' => 'required|max:20',
//            'status'=>'required',
//            'foctax'=>'required',
//
//            'credit_period'=>'required',
//
//        ]);
//
//        $input = $request->all();
//
//        $order = Order::create($input);

//        return back()->with('success', 'order placed successfully.');
        $order=new Order();
        $order->id=$request->id;
        $order->order_date=$request->order_date;
        $order->customer=session('customerId');
        $order->reference_number=$request->reference_number;
        $order->foctax=$request->foctax;
        $order->invoice_discount=$request->invoice_discount;
        $order->credit_period=$request->credit_period;

        $order->save();

        return redirect('saveorder')->back()->with('success', 'order placed successfully.');
//        return back()->with('success','Successfully place order');
//
//
//        $input = $request->all();
//        $input['service_id'] = $request->service_id;
//        $input['quantity'] = $request->quantity;
//
//        $input['rate'] = item::find($input['rate']);
//        $total =  $input['rate'] * $input['quantity'];
//        $input['total'] = $total;
    }
//    public function ajaxRemoveFromCart(Request $request , $id) {
//        $oldCart = Session::has('cart') ? Session::get('cart') : null;
//        $cart = new Cart($oldCart);
//        $cart->remove($id);
//        $request->session()->put('cart', $cart);
//        return response()->json(array( 'totalqty' => $cart->totalQty, 'totalPrice' => $cart->totalPrice, 'shippingCost' => $cart->shippingCost, 'subTotal' => $cart->subTotal));
//    }

}
