<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\multiimg;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function allProduct(){
        $products = Product::all();
        return view('admin.product.all_product',compact('products'));
    }
    public function addProduct(){
        $active_vendor = User::where('status','active')->where('role','vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('admin.product.add_product',compact('active_vendor','brands','categories'));
    }
    public function StoreProduct(Request $request){


        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        'Image'::make($image)->resize(800,800)->save('uploads/products/thumbnail/'.$name_gen);
        $save_url = 'uploads/products/thumbnail/'.$name_gen;

        $product_id = Product::insertGetId([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'product_thumbnail' => $save_url,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        /// Multiple Image Upload From her //////

        $images = $request->file('multi_img');
        foreach($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        'Image'::make($img)->resize(800,800)->save('uploads/products/multi-image/'.$make_name);
        $uploadPath = 'uploads/products/multi-image/'.$make_name;


        multiimg::insert([

            'product_id' => $product_id,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),

        ]);
        } // end foreach

        /// End Multiple Image Upload From her //////

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);


    } // End Method

   public function EditProduct($id){
    $multiImgs = multiimg::where('product_id',$id)->get();
        $active_vendor = User::where('status','active')->where('role','vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $products = Product::findOrFail($id);
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
       return view('admin.product.edit_product',compact('brands','categories','active_vendor','products','subcategories','multiImgs'));
    }


    public function UpdateProduct(Request $request){

        $product_id = $request->id;

        Product::findOrFail($product_id)->update([

       'brand_id' => $request->brand_id,
       'category_id' => $request->category_id,
       'subcategory_id' => $request->subcategory_id,
       'product_name' => $request->product_name,
       'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),

       'product_code' => $request->product_code,
       'product_qty' => $request->product_qty,
       'product_tags' => $request->product_tags,
       'product_size' => $request->product_size,
       'product_color' => $request->product_color,

       'selling_price' => $request->selling_price,
       'discount_price' => $request->discount_price,
       'short_descp' => $request->short_descp,
       'long_descp' => $request->long_descp,

       'hot_deals' => $request->hot_deals,
       'featured' => $request->featured,
       'special_offer' => $request->special_offer,
       'special_deals' => $request->special_deals,


       'vendor_id' => $request->vendor_id,
       'status' => 1,
       'created_at' => Carbon::now(),

   ]);


    $notification = array(
       'message' => 'Product Updated Without Image Successfully',
       'alert-type' => 'success'
   );

   return redirect()->route('all.product')->with($notification);

}// End Method

public function UpdateProductThumbnail(Request $request){

    $pro_id = $request->id;
    $oldImage = $request->old_img;

    $image = $request->file('product_thumbnail');
    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    'Image'::make($image)->resize(800,800)->save('uploads/products/thumbnail/'.$name_gen);
    $save_url = 'uploads/products/thumbnail/'.$name_gen;

     if (file_exists($oldImage)) {
       unlink($oldImage);
    }

    Product::findOrFail($pro_id)->update([

        'product_thumbnail' => $save_url,
        'updated_at' => Carbon::now(),
    ]);

   $notification = array(
        'message' => 'Product Image Thumbnail Updated Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);


}// End Method

public function UpdateProductMultiImg(Request $request){

    $imgs = $request->multi_img;

    foreach($imgs as $id => $img){
        $imgDel = multiimg::find($id);
        unlink($imgDel->photo_name);

        $make_name = rand().'.'.$img->getClientOriginalExtension();
        'Image'::make($img)->resize(800,800)->save('uploads/products/multi-image/'.$make_name);
        $uploadPath = 'uploads/products/multi-image/'.$make_name;

        multiimg::where('id', $id)->update([
            'photo_name' => $uploadPath,
            'updated_at' => Carbon::now(),


        ]);
    }//end foreach
    $notification = array(
        'message' => 'Product Multi Image  Updated Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
}

public function productDelete($id){
    $oldImg = multiimg::find($id);
    unlink($oldImg->photo_name);

    multiimg::find($id)->delete();
    $notification = array(
        'message' => 'Product Multi Image  deleted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);

}

public function productInactive($id){

    Product::find($id)->update([
     'status' => 0,
    ]);
    $notification = array(
        'message' => 'Product Inactive Successfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);

}
public function productActive($id){

    Product::find($id)->update([
     'status' => 1,
    ]);
    $notification = array(
        'message' => 'Product Activated Successfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);

}

public function SingleProductDelete($id){
    $product = Product::find($id);
    unlink($product->product_thumbnail);
    Product::find($id)->delete();

    $images = multiimg::where('product_id', $id)->get();
    foreach($images as $image){
        unlink($image->photo_name);
        multiimg::where('product_id', $id)->delete();
    }
    $notification = array(
        'message' => 'Product Deleted Successfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);
}
}
