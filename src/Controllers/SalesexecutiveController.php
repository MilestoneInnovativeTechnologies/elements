<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;
use Milestone\Elements\Models\Order;

class SalesexecutiveController extends Controller
{
    public function index()
    {
        $data = Order::where('sales_executive', '1')->paginate($this->pageno);
        return view('Elements::se_dashboard', compact( 'data'));
    }

    public function dashboard()
    {
        $data = Order::where('sales_executive', '1')->paginate($this->pageno);
        return view('Elements::admindashboard', compact( 'data'));
    }
}
