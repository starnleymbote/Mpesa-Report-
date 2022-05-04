<?php

namespace App\Http\Controllers;

use Validate;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            
            'password' => 'required',
            'newpassword' => 'required|confirmed',

        ]);
        
        return $request;
        
    }
}
