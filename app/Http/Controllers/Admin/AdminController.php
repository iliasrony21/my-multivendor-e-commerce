<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function index(){
        return view('admin.dashboard');
    }
    function login(){
        return view('admin.adminlogin');
    }
    //authenticatedsessioncontroller ar destroy method full copy and then paste here
    function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/login');
    }
    function profile(){
        $adminInfo = User::find(Auth::user()->id);
        return view('admin.profile',compact('adminInfo'));
    }
    function updateProfile(Request $request){
        $adminData = User::find(Auth::user()->id);
        $adminData->name = $request->name;
        $adminData->userName = $request->userName;
        $adminData->email = $request->email;
        $adminData->phone = $request->phone;
        $adminData->address = $request->address;
        if($request ->image){
            $image = $request->file('image');
            $customName = rand().".".$image->getClientOriginalExtension();
            @unlink(public_path('uploads/admin/'.$adminData->profile_pic));
            $image->move(public_path('uploads/admin/'),$customName);
            $adminData->profile_pic = $customName;
        }
        $adminData->update();
        $notification = array(
            'message'=>'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    function changePassword(){
        return view('admin.changePassword');
    }
    function updatePassword(Request $request){
        $request->validate([
            'old_password'=> 'required',
            'new_password'=> 'required| confirmed'
        ]);
        //find user
        $find = User::find(Auth::user()->id);

        //password match
        if(!Hash::check($request->old_password, $find->password)){
            $notification = array(
                'message'=>'old password do not matched',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);

        }
        //update password
        $find->password = Hash::make($request->new_password);
        $find->update();
        $notification = array(
            'message'=>'Password Successfully Changed',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function inactive(){
        $inactiveVendor = User::where('status','inactive')->where('role','vendor')->latest()->get();
        return view('admin.vendor.inactive',compact('inactiveVendor'));
    }
    public function active(){
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        return view('admin.vendor.active',compact('activeVendor'));
    }
    public function inactive_vendor_details($id){
        $inactiveVendorDetails = User::findOrFail($id);
        return view('admin.vendor.inactive_vendor_details',compact('inactiveVendorDetails'));

    }
    public function active_vendor_details($id){
        $activeVendorDetails = User::findOrFail($id);
        return view('admin.vendor.active_vendor_details',compact('activeVendorDetails'));

    }
    public function activeVendorApproved(Request $request){
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id);
        $user->status = 'active';
        $user->update();
        $notification = array(
            'message'=>'vendor successfully activate',
            'alert-type' => 'success'
        );
        return redirect()->route('vendor.active')->with($notification);
    }
    public function inactiveVendorApproved(Request $request){
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id);
        $user->status = 'inactive';
        $user->update();
        $notification = array(
            'message'=>'vendor successfully activate',
            'alert-type' => 'success'
        );
        return redirect()->route('vendor.inactive')->with($notification);
    }
}
