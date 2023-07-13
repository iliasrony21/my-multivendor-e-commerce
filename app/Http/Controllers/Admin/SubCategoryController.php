<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.subcategory.add',compact('categories'));
    }
    public function store(Request $request){

        $subcategory = new SubCategory;
        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->subcategory_slug = Str::slug($request->subcategory_name);
        if($request->subcategory_image){
            $image = $request->file('subcategory_image');
            $customName = rand().".".$image->getClientOriginalExtension();
            $path = public_path('uploads/subcategory/'.$customName);
            "Image"::make($image)->resize('100 100')->save($path);
            $subcategory->subcategory_image = $customName;

        }
        $subcategory->save();
        $notice = array(
            'type'=>'success',
            'message'=>'subcategory Successfully submitted',

        );
        return back()->with($notice);
    }
    function manage(){
        $subcategories = SubCategory::all();
        return view('admin.subcategory.manage',compact('subcategories'));
    }
    function edit($id){
        $categories = Category::all();
        $subcategory = SubCategory::find($id);
        return view('admin.subcategory.edit',compact('subcategory','categories'));
    }
    function subcategoryDelete($id){
        $subcategory = SubCategory::find($id);
        $subcategory->delete();
        return back();
    }
    function update(Request $request, $id){
        $subcategory = SubCategory::find($id);
        if($request->subcategory_image){
            if('File'::exists(public_path('uploads/subcategory/'.$subcategory->subcategory_image))){
                'File'::delete(public_path('uploads/subcategory/'.$subcategory->subcategory_image));

            }
            $image = $request->file('subcategory_image');
            $customName = rand().".".$image->getClientOriginalExtension();
            $path = public_path('uploads/subcategory/'.$customName);
            "Image"::make($image)->resize('100 100')->save($path);
            $subcategory->subcategory_image = $customName;
            $subcategory->category_id = $request->category_id;
            $subcategory->subcategory_name = $request->subcategory_name;
            $subcategory->subcategory_slug = Str::slug($request->subcategory_name);
            $subcategory->update();
            $notice = array(
                'type'=>'success',
                'message'=>'subcategory Successfully submitted',

            );
            return redirect()->route('subcategory.manage')->with($notice);
        }
        else{
            $subcategory->category_id = $request->category_id;
            $subcategory->subcategory_name = $request->subcategory_name;
            $subcategory->subcategory_slug = Str::slug($request->subcategory_name);
            ;
            $subcategory->update();
            $notice = array(
                'type'=>'success',
                'message'=>'subcategory Successfully submitted',

            );
            return redirect()->route('subcategory.manage')->with($notice);
        }
    }

    public function GetSubcategory($category_id){
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name','ASC')->get();
        return json_encode($subcat);

    }
}
