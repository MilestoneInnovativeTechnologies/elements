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
    public function  store(request $request)
    {
        $this->validate($request,[
            'firstname'=>'required|max:20',
            'lastname'=>'required|max:20',



        ]);
    }
}
