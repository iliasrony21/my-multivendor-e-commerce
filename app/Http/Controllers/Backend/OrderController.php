<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function PendingOrder(){
        $orders = Order::where('status','pending')->orderBy('id','DESC')->get();
        return view('admin.order.pending_order',compact('orders'));
    }

    public function AdminOrderDetails($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('admin.order.admin_order_details',compact('order','orderItem'));

    }// End Method

    public function AdminConfirmedOrder(){
        $orders = Order::where('status','confirm')->orderBy('id','DESC')->get();
        return view('admin.order.confirmed_orders',compact('orders'));
    } // End Method


 public function AdminProcessingOrder(){
        $orders = Order::where('status','processing')->orderBy('id','DESC')->get();
        return view('admin.order.processing_orders',compact('orders'));
    } // End Method


    public function AdminDeliveredOrder(){
        $orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
        return view('admin.order.delivered_orders',compact('orders'));
    } // End Method

    public function PendingToConfirm($order_id){
        Order::findOrFail($order_id)->update(['status' => 'confirm']);

        $notification = array(
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.confirmed.order')->with($notification);


    }// End Method

    public function ConfirmToProcess($order_id){
        Order::findOrFail($order_id)->update(['status' => 'processing']);

        $notification = array(
            'message' => 'Order Processing Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.processing.order')->with($notification);


    }// End Method


      public function ProcessToDelivered($order_id){
        Order::findOrFail($order_id)->update(['status' => 'delivered']);

        $notification = array(
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.delivered.order')->with($notification);


    }// End Method

    public function AdminInvoiceDownload($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = 'Pdf'::loadView('admin.order.admin_order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }// End Method
}
