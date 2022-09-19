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
            if (!$request->session()->has('cart')) {
                $cart = $request->session()->put('cart', []);
            } else {
                $cart = $request->session()->get('cart');
            }
            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $item = Item::where('id', $id)->get();
                $cart[$id] = [
                    "name" => $item[0]->displayname,
                    "quantity" => 1,
                    "rate" => $item[0]->rate,
                ];
            }
            $request->session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
    }


//        https://laraveltuts.com/laravel-9-shopping-cart-tutorial-with-ajax-example/

}
