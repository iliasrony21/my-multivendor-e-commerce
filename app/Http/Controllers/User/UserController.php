<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function index(){
        $userData = User::find(Auth::user()->id);
        return view('index',compact("userData"));
    }
    function userLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    function updateProfile(Request $request){
        $userData = User::find(Auth::user()->id);
        $userData->name = $request->name;
        $userData->userName = $request->userName;
        $userData->email = $request->email;
        $userData->phone = $request->phone;
        $userData->address = $request->address;
        if($request ->image){
            $image = $request->file('image');
            $customName = rand().".".$image->getClientOriginalExtension();
            @unlink(public_path('uploads/user/'.$userData->profile_pic));
            $image->move(public_path('uploads/user/'),$customName);
            $userData->profile_pic = $customName;
        }
        $userData->update();
        return back();
    }
    public function UserUpdatePassword(Request $request){
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't Match!!");
        }

        // Update The new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);
        return back()->with("status", " Password Changed Successfully");

    } // End Mehtod

}
