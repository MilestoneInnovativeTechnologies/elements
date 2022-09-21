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
            if (!$request->session()->has('cart')) {
                $cart = $request->session()->put('cart', []);
            } else {
                $cart = $request->session()->get('cart');
            }
            if (isset($cart[$id])) {
//                $cart[$id]['quantity']++;
                $cart[$id]['quantity'] = $myQty;
                $cart[$id]['foc_quantity'] = $myFocQty;
            } else {
                $item = Item::where('id', $id)->get();
                $cart[$id] = [
                    "name" => $item[0]->displayname,
                    "quantity" => $myQty,
                    "foc_quantity" => $myFocQty,
                    "rate" => $item[0]->rate,
                    "taxpercent" => $item[0]->tax_percent,
                ];
            }
            $request->session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
    }
    public function saveorder(){
        \Illuminate\Support\Facades\Session::flush();
        echo 'Session destroyed';
    }


//        https://laraveltuts.com/laravel-9-shopping-cart-tutorial-with-ajax-example/

}
