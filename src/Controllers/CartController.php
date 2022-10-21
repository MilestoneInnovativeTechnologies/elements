<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;

use Milestone\Elements\Models\Item;



class CartController extends Controller
{
    public function addtocart(Request $request)
    {
        if ($request->has('myId')) {
            $id = $request->input('myId');
            $myQty = $request->input('myQty');
            $myFocQty = $request->input('myFocQty');
            $myRate = $request->input('myRate');
            $myminRate = $request->input('myminRate');
            if (!$request->session()->has('cart')) {
                $cart = $request->session()->put('cart', []);
            } else {
                $cart = $request->session()->get('cart');
            }
            if (isset($cart[$id])) {
//                $cart[$id]['quantity']++;
                $cart[$id]['quantity'] = $myQty;
                $cart[$id]['foc_quantity'] = $myFocQty;
                $cart[$id]['rate'] = $myRate;
            } else {
                $item = Item::where('id', $id)->get();
                $cart[$id] = [
                    "name" => $item[0]->displayname,
                    "quantity" => $myQty,
                    "foc_quantity" => $myFocQty,
                    "rate" => $myRate,
                    "minrate" => $myminRate,
                    "factor" => $item[0]->factor,
                    "taxrule" => $item[0]->tax_rule,
                    "taxpercent" => $item[0]->tax_percent,
                    "discount" => 0,
                ];
            }
            $request->session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
    }

    public function updateitem(Request $request)
    {
        $id = $request->input('editid');
        $quantity =  $request->input('editquantity');
        $focquantity =  $request->input('editfocquantity');
        $rate = $request->input('editrate');
        $discount =  $request->input('editdiscount');
        $oldcart = $request->session()->get('cart');
        if($quantity ==0){
            unset($oldcart[$id]);
        }else{
            $oldcart[$id]['quantity'] = $quantity;
            $oldcart[$id]['foc_quantity'] = $focquantity;
            $oldcart[$id]['rate'] = $rate;
            $oldcart[$id]['discount'] = $discount;
        }
        $request->session()->put('cart', $oldcart);
        return redirect()->back()->with('success', 'Cart have updated successfully');
    }

    public function deleteitem(Request $request)
    {
        $id = $request->input('deleteid');
        $currentCart = $request->session()->get('cart');
        if (array_key_exists($id, $currentCart)){
            unset($currentCart[$id]);
            $request->session()->put('cart', $currentCart);
        }
        return redirect()->back()->with('success', 'You have deleted a item');
    }

    function ordersessioncreate(Request $request)
    {
        if (!$request->session()->has('order')) {
            $orderArr['invoicediscount'] = '';
            $orderArr['referencenumber'] = '';
            $orderArr['creditperiod'] = '';
            $orderArr['foc'] = '';
            $order = $request->session()->put('order', $orderArr);
        } else {
            $order = $request->session()->get('order');
        }
        return $order;
    }

    public function invoicediscount(Request $request)
    {
        $oldorder =  $this->ordersessioncreate($request);
        $oldorder['invoicediscount'] = $request->input('invoicediscount');
        $request->session()->put('order', $oldorder);
        return redirect()->back()->with('success', 'You have added invoice discount successfully');
    }

    public function foc(Request $request)
    {
        $focval = $request->input('val');
        $oldorder =  $this->ordersessioncreate($request);
        if($focval == 1){
            $oldorder['foc'] =$focval;
            $msg = "Foc tax has added successfully.";
        }else{
            $oldorder['foc'] ='';
            $msg = "Foc tax has removed successfully.";
        }
        $request->session()->put('order', $oldorder);
        return response()->json(array('msg'=> $msg), 200);
    }
    public function referencenumber(Request $request)
    {
        $oldorder = $this->ordersessioncreate($request);
        $oldorder['referencenumber'] = $request->input('val');
        $request->session()->put('order', $oldorder);
        $msg ="Reference Number has added successfully.";
        return response()->json(array('msg'=> $msg), 200);
    }
    public function creditperiod(Request $request)
    {

        $oldorder = $this->ordersessioncreate($request);
        $oldorder['creditperiod'] = $request->input('val');
        $request->session()->put('order', $oldorder);
        $msg = "Reference Number has added successfully.";
        return response()->json(array('msg'=> $msg), 200);
    }


    public function clearcart(Request $request) {
        $request->session()->forget(['cart', 'order','customer']);
        $request->session()->flush();
        echo 'Session destroyed';
    }


//        https://laraveltuts.com/laravel-9-shopping-cart-tutorial-with-ajax-example/

}
