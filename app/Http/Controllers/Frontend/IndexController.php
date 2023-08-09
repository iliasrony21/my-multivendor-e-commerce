<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\multiimg;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Image;
use Carbon\Carbon;

class IndexController extends Controller
{

    public function productDetails($id,$slug){
        $product = Product::findOrFail($id);
        $color = $product->product_color;
        $product_color = explode(',',$color);

        $size = $product->product_size;
        $product_size = explode(',', $size);
        $multi = multiimg::where('product_id',$id)->get();

        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();
        return view('frontend.product.productdetails',compact('product','product_color','product_size','multi','relatedProduct'));
    }//End method

    public function Index() {
            $skip_category_1 = Category::skip(1)->first();
            $skip_product_1 = Product::where('status',1)->where('category_id',$skip_category_1->id)->limit(5)->get();

            $skip_category_4 = Category::skip(4)->first();
            $skip_product_4 = Product::where('status',1)->where('category_id',$skip_category_4->id)->limit(5)->get();
            $skip_category_5 = Category::skip(5)->first();
            $skip_product_5 = Product::where('status',1)->where('category_id',$skip_category_5->id)->limit(5)->get();

            $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
            $special_offer = Product::where('special_offer',1)->orderBy('id','DESC')->limit(3)->get();
            $new = Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();
            $special_deals = Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();



            return view('frontend.index',compact('skip_category_1','skip_product_1','skip_category_4','skip_product_4','skip_product_1','skip_category_5','skip_product_5','hot_deals','special_offer','new','special_deals'));
        }

        public function vendorDetails($id){
            $vendor =  User::findOrFail($id);
            $vendorProduct = Product::where('vendor_id',$id)->get();
            return view('frontend.vendorfrontend.vendor_details',compact('vendorProduct','vendor'));
        }
        public function vendorAll(){

            $vendors = User::where('status','active')->where('role','vendor')->get();

            return view('frontend.vendorfrontend.vendor_all',compact('vendors'));
        }

        public function catViewDetails(Request $request,$id,$slug){

            $products = Product::where('status',1)->where('category_id',$id)->get();
            $categories = Category::orderBy('category_name','ASC')->get();
            $catname = Category::where('id',$id)->first();
            $newProduct = Product::orderBy('id','DESC')->limit(3)->get();

            return view('frontend.product.category_view',compact('products','categories','catname','newProduct'));
        }
        public function subCatViewDetails(Request $request,$id,$slug){

            $products = Product::where('status',1)->where('subcategory_id',$id)->get();
            $categories = Category::orderBy('category_name','ASC')->get();
            $subcatname = SubCategory::where('id',$id)->first();
            $newProduct = Product::orderBy('id','DESC')->limit(3)->get();

            return view('frontend.product.subcategory_view',compact('products','categories','subcatname','newProduct'));
        }
        public function productViewModal($id){

            $product = Product::with('category','brand')->findOrFail($id);
            $color = $product->product_color;
            $product_color = explode(',',$color);

            $size = $product->product_size;
            $product_size = explode(',', $size);

            return response()->json(array(
                'product'=>$product,
                'color'=>$product_color,
                'size'=>$product_size,


            ));
        }


}
