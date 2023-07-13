<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index(){
        return view('admin.brand.add');
    }
    public function store(Request $request){
        $request->validate ([
            'brand_name'=>'required',
            'brand_image'=>'required',

        ],
        [
            'brand_name.required' => 'Brand name is Required',
            'brand_image.required' => 'Brand image is not found',

        ]);
        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = Str::slug($request->brand_name);
        if($request->brand_image){
            $image = $request->file('brand_image');
            $customName = rand().".".$image->getClientOriginalExtension();
            $path = public_path('uploads/brand/'.$customName);
            "Image"::make($image)->resize('100 100')->save($path);
            $brand->brand_image = $customName;

        }
        $brand->save();
        $notice = array(
            'type'=>'success',
            'message'=>'Brand Successfully submitted',

        );
        return back()->with($notice);
    }
    function manage(){
        $brands = Brand::all();
        return view('admin.brand.manage',compact('brands'));
    }
    function edit($id){
        $brand = Brand::find($id);
        return view('admin.brand.edit',compact('brand'));
    }
    function brandDelete($id){
        $brand = Brand::find($id);
        $brand->delete();
        return back();
    }
    function update(Request $request, $id){
        $brand = Brand::find($id);
        if($request->brand_image){
            if('File'::exists(public_path('uploads/brand/'.$brand->brand_image))){
                'File'::delete(public_path('uploads/brand/'.$brand->brand_image));

            }
            $image = $request->file('brand_image');
            $customName = rand().".".$image->getClientOriginalExtension();
            $path = public_path('uploads/brand/'.$customName);
            "Image"::make($image)->resize('100 100')->save($path);
            $brand->brand_image = $customName;
            $brand->brand_name = $request->brand_name;
            $brand->brand_slug = Str::slug($request->brand_name);
            $brand->update();
            $notice = array(
                'type'=>'success',
                'message'=>'Brand Successfully submitted',

            );
            return redirect()->route('brand.manage')->with($notice);
        }
        else{
            $brand->brand_name = $request->brand_name;
            $brand->brand_slug = Str::slug($request->brand_name);
            ;
            $brand->update();
            $notice = array(
                'type'=>'success',
                'message'=>'Brand Successfully submitted',

            );
            return redirect()->route('brand.manage')->with($notice);
        }
    }
}
