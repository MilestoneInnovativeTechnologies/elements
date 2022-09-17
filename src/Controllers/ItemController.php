<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;
use Milestone\Elements\Models\Item;

class ItemController extends Controller
{
    public function itemlist()
    {
        $data = Item::orderBy('id')->paginate($this->pageno);
        return view('Elements::itemlist', compact( 'data'));
    }
}
