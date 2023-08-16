<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request, $product_id){
        if(Auth::check()){
            $exists = wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();
            if(!$exists){
                wishlist::insert([

                    'user_id'=>Auth::id(),
                    'product_id'=> $product_id,
                    'created_at'=>Carbon::now(),

                ]);
                return response()->json(['success' => 'successfully added on your wishlist']);
            }
            else{
                return response()->json(['error' => 'Already added on your wishlist']);

            }
        }
        else{
            return response()->json(['error' => 'Please login first']);

        }
    }
    public function wishlistPage(){
        return view('frontend.wishlist.wishlist_page');
    }

    public function wishlistViewPage(){
        $wishlist = Wishlist::with("product")->where('user_id', Auth::id())->latest()->get();
        $wishQty = Wishlist::count();
        return response()->json(['wishlist'=>$wishlist, 'wishQty'=>$wishQty]);
    }
    public function wishlistRemove($id){
        wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success'=>'Successfully removed from your wishlist']);
    }
}
