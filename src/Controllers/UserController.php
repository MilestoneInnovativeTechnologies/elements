<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;
use Milestone\Elements\Models\User;

class UserController extends Controller
{
    public function profile()
    {
        $data = User::find(auth()->id())->get();
        return view('Elements::profile', compact( 'data'));
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

}
