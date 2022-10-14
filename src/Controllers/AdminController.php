<?php

namespace Milestone\Elements\Controllers;

use Couchbase\GetAllUsersOptions;
use Illuminate\Http\Request;
use Milestone\Elements\Models\Order;


class AdminController extends Controller
{
    public function index()
    {
        $class = 'dashboard';
        $data = Order::where('status', 'Pending')->paginate($this->pageno);
//        dd($data);
        return view('Elements::admin_dashboard', compact( 'data', 'class'));


    }

}
