@extends('admin.master')
  @section('admin')
  <script src="{{asset('backend')}}/assets/js/jquery.min.js"></script>
  <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3"> All Products</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All products</li>
							</ol>
						</nav>
					</div>

				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">

							<div class="col-lg-8 offset-2">


                                <div class="card">
									<div class="card-body">
                                        <table class="col-lg-12">
                                            <thead>

                                            <tr>
                                                <th>#sl</th>
                                                <th>Image </th>
                                                <th>Product Name </th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Discount </th>
                                                <th>Status </th>
                                                <th>Action </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($products) > 0)
                                                @foreach($products as $key => $product)
                                               <tr>
                                               <td>{{ $key+1 }}</td>
                                               <td>
                                                    <img src="{{ asset($product->product_thumbnail) }}" alt="product Image" height="120" width="120">
                                                </td>
                                                <td>{{ $product->product_name }} </td>
                                                <td>{{ $product->selling_price }}</td>
                                                <td>{{ $product->product_qty }}</td>
                                                <td>{{ $product->discount_price }}</td>

                                                <td>{{ $product->status }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="">Edit</a>
                                                    <a class="btn btn-danger btn-sm deleted" href="">Delete</a>
                                                </td>
                                               </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td class="text-center text-warning m-auto"> Data not found</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                 <th>#sl</th>
                                                <th>Image </th>
                                                <th>Product Name </th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Discount </th>
                                                <th>Status </th>
                                                <th>Action </th>
                                            </tr>
                                            </tfoot>
                                        </table>

								   </div>


							</div>
						</div>
					</div>
				</div>
			</div>
            <script>
                'use strict'
                jQuery(document).ready(function(){
                    jQuery(".image").change(function(e){
                    var filereader = new FileReader();
                    filereader.onload = function(e){
                        jQuery('#imagepre').attr('src',e.target.result);
                    }
                    filereader.readAsDataURL(e.target.files['0']);
                    })

                })
            </script>

            @endSection

