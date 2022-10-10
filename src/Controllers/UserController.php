<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $data = '';
        return view('Elements::profile', compact( 'data'));
    }

}
