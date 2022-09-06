<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function itemlist()
    {
//        $data = Client::orderBy('id')->paginate($this->pageno);
        $data = '';
        return view('Elements::itemlist', compact( 'data'));
    }
}
