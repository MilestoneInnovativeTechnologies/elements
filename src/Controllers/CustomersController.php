<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;
use Milestone\Elements\Models\Customers;

class CustomersController extends Controller
{
    public function customerlist()
    {
        $pageno = $this->pageno;
        $data = Customers::orderBy('id')->paginate($pageno);
        return view('Elements::customerlist', compact( 'data', 'pageno'));
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
            $customerData = Customers::where('id', $customerId)->get();
            $customer['id'] = $customerId;
            $customer['name'] =  $customername = $customerData[0]->display_name;
            $customer['credit_period'] = $customerData[0]->credit_period;
            $customer['order_total'] = $customerData[0]->order_total;
            $customer['outstanding'] = $customerData[0]->outstanding;
            $customer['maximum_allowed'] = $customerData[0]->maximum_allowed;
            $request->session()->put('customer', $customer);
            return redirect()->back()->with('success',
                'You have selected '.$customername.' successfully!');
        }
    }
}
