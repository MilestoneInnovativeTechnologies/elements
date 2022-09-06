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

}
