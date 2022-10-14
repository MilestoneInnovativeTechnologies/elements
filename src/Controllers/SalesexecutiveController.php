<?php

namespace Milestone\Elements\Controllers;

use Couchbase\GetAllUsersOptions;
use Illuminate\Http\Request;
use Milestone\Elements\Models\Order;
use Milestone\Elements\Models\User;

class SalesexecutiveController extends Controller
{
    public function index()
    {
        $class = 'dashboard';
        $data = Order::where('sales_executive', auth()->id())->paginate($this->pageno);
        return view('Elements::se_dashboard', compact( 'data', 'class'));
    }

    public function admindashboard()
    {
        $class = 'dashboard';
        $data = Order::where('sales_executive', auth()->id())->paginate($this->pageno);
        return view('Elements::admindashboard', compact( 'data', 'class'));
    }

}
