<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Bycrpt;
use Validate;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {

        $this->validate($request, [
            
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'

        ]);

        $match = Hash::check($request ->input('current_password'), Auth::user()->password);
        
        if($match != 1)
        {
            return back()->with('error', 'Current Password do not mactch');
        }
        
        //hash password
        $encrypt = bcrypt($request ->input('password'));

        $update_password = User::where('id', Auth::user()->id)->update(['password' => $encrypt]);
        
        if(!$update_password)
        {
            return back()->with('error', 'Internal server error');
        }

        return back()->with('success', 'Password changed successfuly');
         
    }

    public function updateProfile(Request $request)
    {
        return view('update_profile');
    }
}
