<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;

class SalesexecutiveController extends Controller
{
    public function index()
    {
        $data = null;
        return view('Elements::se_dashboard', compact( 'data'));

    }
}
