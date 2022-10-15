<?php

namespace Milestone\Elements\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Milestone\Elements\Models\Order;

class SalesexecutiveController extends Controller
{
    public function index()
    {
        $class = 'dashboard';
        $data = Order::where('sales_executive', auth()->id())
            ->where('status', 'Pending')
            ->orWhere('updated_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('id','DESC')
            ->paginate($this->pageno);
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
        $order->update(['status' => 'Cancelled']);
        return redirect()->route('index')->with('success','Order has been deleted successfully');
    }

}
