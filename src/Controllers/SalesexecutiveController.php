<?php

namespace Milestone\Elements\Controllers;

use Couchbase\GetAllUsersOptions;
use Illuminate\Http\Request;
use Milestone\Elements\Models\Order;
use Milestone\Elements\Models\User;

class SalesexecutiveController extends Controller
{
    public function index()
    {
        $data = Order::where('sales_executive', auth()->id())->paginate($this->pageno);
        return view('Elements::se_dashboard', compact( 'data'));
    }
    public function salesexecutive()
    {
        $data = User::where('role', 'executive')->paginate($this->pageno);
        return view('Elements::salesexecutive', compact( 'data'));
    }
    public function salesexecutive_add()
    {
        $data = User::where('role', 'executive')->paginate($this->pageno);
        return view('Elements::se_add', compact( 'data'));
    }
    public function salesexecutive_create(Request $request)
    {
        $validatedData = $request->validate( [
            'name' => 'required|min:4',
            'password'=>'required|min:6',
            'email' => 'required|email|unique:users,email',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        $request->session()->flash('success', 'You have saved a SalesExecutive successfully!');
        return redirect('salesexecutive');
    }
}
