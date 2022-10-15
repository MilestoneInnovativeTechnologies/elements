<?php

namespace Milestone\Elements\Controllers;

use Couchbase\GetAllUsersOptions;
use Illuminate\Http\Request;
use Milestone\Elements\Models\Order;
use Milestone\Elements\Models\OrderItem;


class AdminController extends Controller
{
    public function index()
    {
        $class = 'dashboard';
        $data = Order::where('status', 'Pending')->paginate($this->pageno);
//        dd($data);
        return view('Elements::admin_dashboard', compact( 'data', 'class'));


    }

    public function adminorderdisplay($id)
    {
        $data = Order::where('id', $id)->get();
        $data1 = OrderItem::where('order_id', $id)->get();
//        dd($data1 ->toArray());
        return view('Elements::ordersummary');
    }

}
