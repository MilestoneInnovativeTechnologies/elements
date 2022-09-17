<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;
use Milestone\Elements\Models\Customers;
use Milestone\Elements\Models\Item;


class CartController extends Controller
{
    public function selectcustomer(Request $request)
    {
        if ($request->has('customerId')) {
            $customerId = $request->input('customerId');
            $customer = Customers::where('id', $customerId)->get();
//            $customername = $customer[0]->display_name;
            $customername = 'TestName';
            $request->session()->put('customerId', $customerId);
            $request->session()->put('customername', $customername);
            return redirect()->back()->with('success', 'You have selected Customer successfully!'.$request->session()->get('customername'));
        }
    }

    public function addtocart(Request $request)
    {
        $cart = "";
        if ($request->has('myId')) {
            $id = $request->input('myId');
            if (!$request->session()->has('cart')) {
                $cart = $request->session()->put('cart', []);
            } else {
                $cart = $request->session()->get('cart');
            }
            print_r($cart);
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
            print_r($cart);
            $request->session()->put('cart', $cart);
            dd($request->session()->get('cart'));
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
    }


//        https://laraveltuts.com/laravel-9-shopping-cart-tutorial-with-ajax-example/

}
