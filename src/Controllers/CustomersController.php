<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;
use Milestone\Elements\Models\Customers;

class CustomersController extends Controller
{
    public function customerlist()
    {
        $data = Customers::orderBy('id')->paginate($this->pageno);
        return view('Elements::customerlist', compact( 'data'));
    }
    public function customerdetails()
    {
        $data = '';
        return view('Elements::customerdetails', compact( 'data'));
    }
    public function searchcustomer(Request $request)
    {
        if($request->has('search')) {
            $data = Customers::where('display_name', 'LIKE', '%' . request('search') . '%')
                ->paginate($this->pageno);
        }else {
            $data = Customers::orderBy('id')->paginate($this->pageno);
        }
        return view('Elements::customerlist', compact( 'data'));
    }
    public function selectcustomer(Request $request)
    {
        if ($request->has('customerId')) {
            $customerId = $request->input('customerId');
            $customer = Customers::where('id', $customerId)->get();
            $customername = $customer[0]->display_name;
            $request->session()->put('customerId', $customerId);
            $request->session()->put('customername', $customername);
            return redirect()->back()->with('success', 'You have selected '.$request->session()->get('customername').' successfully!');
        }
    }
}
