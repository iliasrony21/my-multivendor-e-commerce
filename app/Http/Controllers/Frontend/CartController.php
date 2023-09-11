<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDivision;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
        if('Session'::has('coupon')){
            'Session'::forget('coupon');
        }

        $product = Product::findOrFail($id);
        if($product->discount_price == NULL){
            Cart::add([
                'id'=>$id,
                'name' =>$request->product_name,
                'qty' =>$request->quantity,
                'price' =>$product->selling_price,
                'weight' =>1,
                'options' =>[
                    'image'=> $product->product_thumbnail,
                    'color'=> $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
                ]);

                return response()->json(['success'=> 'Successfully Added on your Cart']);

        }
        else{
            Cart::add([
                'id'=>$id,
                'name' =>$request->product_name,
                'qty' =>$request->quantity,
                'price' =>$product->discount_price,
                'weight' =>1,
                'options' =>[
                    'image'=> $product->product_thumbnail,
                    'color'=> $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
                ]);

                return response()->json(['success'=> 'Successfully Added on your Cart']);


        }
    }
// Details Add to cart start
    public function DetailsAddToCart(Request $request, $id){
        if('Session'::has('coupon')){
            'Session'::forget('coupon');
        }
        $product = Product::findOrFail($id);
        if($product->discount_price == NULL){
            Cart::add([
                'id'=>$id,
                'name' =>$request->product_name,
                'qty' =>$request->quantity,
                'price' =>$product->selling_price,
                'weight' =>1,
                'options' =>[
                    'image'=> $product->product_thumbnail,
                    'color'=> $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
                ]);

                return response()->json(['success'=> 'Successfully Added on your Cart']);

        }
        else{
            Cart::add([
                'id'=>$id,
                'name' =>$request->product_name,
                'qty' =>$request->quantity,
                'price' =>$product->discount_price,
                'weight' =>1,
                'options' =>[
                    'image'=> $product->product_thumbnail,
                    'color'=> $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
                ]);

                return response()->json(['success'=> 'Successfully Added on your Cart']);


        }
    }
    // Details Add to cart start end

    public function AddToMiniCart(Request $request){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal'=> $cartTotal

        ));
    }

    public function removeMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success'=>'Remove successfully from the minicart']);
    }//End method

    public function MyCart(){

        return view('frontend.mycart.view_mycart');

    }// End Method
    public function GetCartProduct(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal

        ));

    }// End Method

    public function CartRemove($rowId){
        Cart::remove($rowId);

        if('Session'::has('coupon')){
            $coupon_name = 'Session'::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            'Session'::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount'=> $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100),

            ]);

        }

        return response()->json(['success' => 'Successfully Remove From Cart']);

    }// End Method
    public function CartDecrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty -1);

        if('Session'::has('coupon')){
            $coupon_name = 'Session'::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            'Session'::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount'=> $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100),

            ]);

        }

        return response()->json('Decrement');

    }// End Method
    public function CartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty +1);
        if('Session'::has('coupon')){
            $coupon_name = 'Session'::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            'Session'::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount'=> $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100),

            ]);

        }

        return response()->json('Increment');
    }//end method

    public function ApplyCoupon(Request $request){
        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
                    if($coupon){
                        'Session'::put('coupon',[
                            'coupon_name' => $coupon->coupon_name,
                            'coupon_discount'=> $coupon->coupon_discount,
                            'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                            'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100),

                        ]);
                        return response()->json(array(
                            'validity' => true,
                            'success'=>'Coupon successfully applied'

                        ));

                    }
                    else{
                        return response()->json(['error'=>'Invalid coupon']);
                    }



    }

    public function CouponCalculation(){

        if ('Session'::has('coupon')) {

            return response()->json(array(
             'subtotal' => Cart::total(),
             'coupon_name' => session()->get('coupon')['coupon_name'],
             'coupon_discount' => session()->get('coupon')['coupon_discount'],
             'discount_amount' => session()->get('coupon')['discount_amount'],
             'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }// End Method
    public function CouponRemove(){

        'Session'::forget('coupon');
        return response()->json(['success'=>'coupon remove successfully']);
    }// End Method

    public function CheckoutPage(){
        if(Auth::user()){
            if(Cart::total() > 0){
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();
                $divisions = ShipDivision::orderBy('division_name','ASC')->get();
                return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','divisions'));

            }else{
                $notification = array(
                    'message' => 'You need to add at list one product',
                    'alert-type' => 'error',


                );
                return redirect()->to('/')->with($notification);

            }

        }
        else{
            $notification = array(
                'message' => 'You need to login first',
                'alert-type' => 'error',


            );
            return redirect()->route('login')->with($notification);
        }
    }


}
