<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;
use Milestone\Elements\Models\Order;
use Milestone\Elements\Models\User;

class UserController extends Controller
{
    public function profile()
    {
        $data = User::find(auth()->id())->get();
        return view('Elements::user.profile', compact( 'data'));
    }
    public function updateprofile(Request $request)
    {
        $id = auth()->id();
        $updateData = $request->validate( [
            'name' => 'required|min:4',
            'password'=>'required|min:6',
        ]);
        $password = $request->input('password');
        $oldpassword = $request->input('oldpassword');
//        dd($password.'-'.$oldpassword);
        if($oldpassword !== $password){
            $updateData['password'] = bcrypt($password);
        }
        User::whereId($id)->update($updateData);
        return redirect()->back()->with('success', 'Your profile have updated successfully');
    }
    public function index()
    {
        $class = 'user';
//        $data = User::where('role', 'executive')->paginate($this->pageno);
        $data = User::orderBy('id','desc')->paginate($this->pageno);
        return view('Elements::user.index', compact( 'data', 'class'));
    }
    public function create()
    {
        $class = 'user';
        return view('Elements::user.create', compact('class'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate( [
            'name' => 'required|min:4',
            'role' => 'required',
            'password'=>'required|min:6',
            'email' => 'required|email|unique:users,email',
            'status' => 'required',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        return redirect()->route('user.index')->with('success','User has been created successfully.');
    }
    public function show(User $user)
    {
        $class = 'user';
        return view('Elements::user.show',compact('user', 'class'));
    }
    public function edit(User $user)
    {
        $class = 'user';
        return view('Elements::user.edit', compact('user', 'class'));
    }
    public function update(Request $request, User $user)
    {
        $updateData = $request->validate([
            'name' => 'required|min:4',
            'role' => 'required',
            'password'=>'required|min:6',
            'email' => 'required|email|unique:users,email,' .$user->id,
            'status' => 'required',
        ]);
        $password = $request->input('password');
        $oldpassword = $request->input('oldpassword');
        if($oldpassword !== $password){
            $updateData['password'] = bcrypt($password);
        }
//        $user->fill($request->post())->save());
        User::whereId($user->id)->update($updateData);
        return redirect()->route('user.index')->with('success','User has been updated successfully');
    }
    public function destroy(User $user)
    {
        if(Order::where('sales_executive', $user->id)->exists() ){
            $msg = 'Sorry, You cannot delete this record because it is already in use';
            $msgType='error';
        }else{
            $user->delete();
            $msg = 'User has been deleted successfully';
            $msgType='success';
        }
        return redirect()->route('user.index')->with($msgType,$msg);
    }

}


//https://techvblogs.com/blog/laravel-9-crud-application-tutorial-with-example
