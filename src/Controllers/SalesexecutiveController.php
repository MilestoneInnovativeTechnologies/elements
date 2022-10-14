<?php

namespace Milestone\Elements\Controllers;


use Illuminate\Http\Request;
use Milestone\Elements\Models\Order;

class SalesexecutiveController extends Controller
{
    public function index()
    {
        $class = 'dashboard';
        $data = Order::where('sales_executive', auth()->id())->orderBy('id','DESC')->paginate($this->pageno);
        return view('Elements::se_dashboard', compact( 'data', 'class'));
    }
    public function orderhistory()
    {
        $class = 'history';
        $data = Order::where('sales_executive', auth()->id())
            ->orderBy('id','DESC')
            ->paginate($this->pageno);
        return view('Elements::se_orderhistory', compact( 'data', 'class'));
    }
    public function deleteorder($id)
    {
        $order = Order::where('id', $id)->firstOrFail();
        $order->update(['status' => 'Inactive']);
        return redirect()->route('index')->with('success','Order has been deleted successfully');
    }

}
