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
                    "discount" => 0,
                ];
            }
            $request->session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
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
    public function clearcart(Request $request) {
        $request->session()->flush();
        echo 'Session destroyed';
    }

//    public function destroy($id)
//    {
//        Cart::remove($id);
//        session()->flash('success_message',' item has been removed successfully');
//    }

//    public function updateCart(Request $request)
//    {
//        $cart = $request->session()->put('cart', [])::update(
//            $request->id,
//            [
//                'quantity' => [
//                    'relative' => false,
//                    'value' => $request->quantity
//                ],
//            ]
//        );
//
//        session()->flash('success', 'Item Cart is Updated Successfully !');
//
//        return redirect()->route('ordersummary');
//    }


//        foreach ($items as &$item) {
//            if ($item['deleteid'] == $id) {
//                unset($item);
//            }
//        }
//
//        //Session::set('cart.items', $items);
//        $request->session()->put('cart', $items);
//
//        return 'removed';
//    }
//    public function deleteitem(Request $request,$id)
//    {
//        $cart = session('cart');
//        foreach ($cart as $key => $value)
//        {
//            if ($value['id'] == $id)
//            {
//                unset($cart [$key]);
//            }
//        }
//        //put back in session array without deleted item
//        $request->session()->push('cart',$cart);
//        //then you can redirect or whatever you need
//        return redirect()->back();
//    }

//

//

//        https://laraveltuts.com/laravel-9-shopping-cart-tutorial-with-ajax-example/

}
