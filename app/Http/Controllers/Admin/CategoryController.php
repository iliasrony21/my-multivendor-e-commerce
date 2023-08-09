<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.category.add');
    }
    public function store(Request $request){

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->category_slug = Str::slug($request->category_name);
        if($request->category_image){
            $image = $request->file('category_image');
            $customName = rand().".".$image->getClientOriginalExtension();
            $path = public_path('uploads/category/'.$customName);
            "Image"::make($image)->resize('80 80')->save($path);
            $category->category_image = $customName;

        }
        $category->save();
        $notice = array(
            'type'=>'success',
            'message'=>'category Successfully submitted',

        );
        return back()->with($notice);
    }
    function manage(){
        $categories = Category::all();
        return view('admin.category.manage',compact('categories'));
    }
    function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }
    function categoryDelete($id){
        $category = Category::find($id);
        $category->delete();
        return back();
    }
    function update(Request $request, $id){
        $category = Category::find($id);
        if($request->category_image){
            if('File'::exists(public_path('uploads/category/'.$category->category_image))){
                'File'::delete(public_path('uploads/category/'.$category->category_image));

            }
            $image = $request->file('category_image');
            $customName = rand().".".$image->getClientOriginalExtension();
            $path = public_path('uploads/category/'.$customName);
            "Image"::make($image)->resize('80 80')->save($path);
            $category->category_image = $customName;
            $category->category_name = $request->category_name;
            $category->category_slug = Str::slug($request->category_name);
            $category->update();
            $notice = array(
                'type'=>'success',
                'message'=>'category Successfully submitted',

            );
            return redirect()->route('category.manage')->with($notice);
        }
        else{
            $category->category_name = $request->category_name;
            $category->category_slug = Str::slug($request->category_name);
            ;
            $category->update();
            $notice = array(
                'type'=>'success',
                'message'=>'category Successfully submitted',

            );
            return redirect()->route('category.manage')->with($notice);
        }
    }
}
