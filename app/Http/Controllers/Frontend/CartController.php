<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){

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
                ],
                ]);

                return response()->json(['success'=> 'Successfully Added on your Cart']);


        }
    }
// Details Add to cart start
    public function DetailsAddToCart(Request $request, $id){

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

        return response()->json(['success' => 'Successfully Remove From Cart']);

    }// End Method
    public function CartDecrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty -1);

        return response()->json('Decrement');

    }// End Method
    public function CartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty +1);

        return response()->json('Increment');
    }


}
