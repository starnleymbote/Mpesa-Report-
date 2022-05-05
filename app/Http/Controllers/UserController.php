<?php

namespace App\Http\Controllers;


use Auth;
use Hash;
use Image;
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

        $this ->validate($request, [

            'full_names' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'avatar' => 'nullable|mimes:png,jpg,jpeg|max:4096',

        ]);


        if($request ->hasFile('avatar'))
        {

            $filenamewithExt = $request ->file('avatar')->getClientOriginalName();
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            /**UPLOAD THE FILE */
            $path = $request->file('avatar')->storeAs('public/users_avatar',$fileNameToStore);

             /**RESIZE IMAGE HERE*/
             $thumbnailpath = public_path('storage/users_avatar/'.$fileNameToStore);
             $img = Image::make($thumbnailpath)->resize(260, 260, function($constraint) {
                 $constraint->aspectRatio();
             });
             $img->save($thumbnailpath);

        }
        
        else
        {
            
            $fileNameToStore="default_user_avatar.png";
        }

        //Create an instance of the user
        $user = User::find(Auth::user()->id);

        $user ->name = $request ->input('full_names');
        $user ->phone = $request ->input('phone');
        $user ->email = $request ->input('email');
        $user ->password = Auth::user()->password;
        $user ->avatar = $fileNameToStore;

        $user ->save();
        
        return view('profile');
    }
}
