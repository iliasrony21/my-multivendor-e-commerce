<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    function index(){
        return view('vendor.dashboard');
    }
    function login(){
        return view('vendor.vendorlogin');
    }
    function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('vendor/login');
    }
    function profile(){
        $vendorInfo = User::find(Auth::user()->id);
        return view('vendor.profile',compact('vendorInfo'));
    }
    function updateProfile(Request $request){
        $vendorData = User::find(Auth::user()->id);
        $vendorData->name = $request->name;
        $vendorData->userName = $request->userName;
        $vendorData->email = $request->email;
        $vendorData->phone = $request->phone;
        $vendorData->address = $request->address;
        $vendorData->vendor_join = $request->vendor_join;
        $vendorData->vendor_short_info = $request->vendor_short_info;

        if($request ->image){
            $image = $request->file('image');
            $customName = rand().".".$image->getClientOriginalExtension();
            @unlink(public_path('uploads/vendor/'.$vendorData->profile_pic));
            $image->move(public_path('uploads/vendor/'),$customName);
            $vendorData->profile_pic = $customName;
        }
        $vendorData->update();
        $notification = array(
            'message'=>'Vendor Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
    function changePassword(){
        return view('vendor.changePassword');
    }
    function updatePassword(Request $request){
        $request->validate([
            'old_password'=> 'required',
            'new_password'=> 'required| confirmed'
        ]);
        //find user
        $finds = User::find(Auth::user()->id);

        //password match
        if(!Hash::check($request->old_password, $finds->password)){
            $notification = array(
                'message'=>'Old Password does not matched',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);

        }
        //update password
        $finds->password = Hash::make($request->new_password);
        $finds->update();
        $notification = array(
            'message'=>'Password Successfully Changed',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function become_vendor(){
        return view('auth.become_vendor');
    }
    public function vendorRegistration(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::insert([
            'name' => $request->name,
            'userName' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'vendor_join' => $request->vendor_join,
            'role' => 'vendor',
            'status' => 'inactive',
            'password' => Hash::make($request->password),
        ]);

        $notification = array(
            'message'=>'Vendor Registration successfully done',
            'alert-type' => 'success'
        );
        return redirect()->route('vendor.login')->with($notification);

    }
}
