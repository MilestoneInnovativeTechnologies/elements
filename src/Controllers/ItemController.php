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
    public function searchitems(Request $request)
    {
        if($request->has('search')) {
            $data = Item::where('displayname', 'LIKE', '%' . request('search') . '%')->paginate($this->pageno);
        }else {
            $data = Item::orderBy('id')->paginate($this->pageno);
        }
        return view('Elements::itemlist', compact( 'data'));
    }
}
