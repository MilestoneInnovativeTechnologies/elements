<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function customerlist()
    {
        $data = '';
        return view('Elements::customerlist', compact( 'data'));
    }
    public function customerdetails()
    {
        $data = '';
        return view('Elements::customerdetails', compact( 'data'));
    }
}
