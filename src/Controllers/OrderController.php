<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function ordersummary()
    {
        $data = '';
        return view('Elements::ordersummary', compact( 'data'));
    }
    public function  store(request $request)
    {
        $this->validate($request, [
            'paymentmode' => 'required',
            'referencenumber' => 'required|max:20',
            'salesexecutive' => 'required|max:20',
            'status'=>'required|max:20',
            'foctax'=>'required|max:20',









        ]);
        return back()->with('success','Successfully place order');
    }
}
