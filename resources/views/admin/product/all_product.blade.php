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
								<li class="breadcrumb-item active" aria-current="page">All Product  <span class="badge rounded-pill bg-danger"> {{ count($products) }} </span> </li>
							</ol>
						</nav>
					</div>
                    <div class="ms-auto">
						<div class="btn-group">
		                  <a href="{{ route('add.product') }}" class="btn btn-primary mb-3 ml-5">Add Product</a>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->

				<div class="container">
					<div class="main-body">
						<div class="row">

							<div class="col-lg-12 ">


                                <div class="card">
									<div class="card-body">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                                                <td>
                                                    @if($product->discount_price == NULL)
                                                    <span class="badge rounded-pill bg-info">No Discount</span>
                                                    @else
                                                    @php
                                                    $amount = $product->selling_price - $product->discount_price;
                                                    $discount = ($amount/$product->selling_price) * 100;
                                                    @endphp
                                                   <span class="badge rounded-pill bg-danger"> {{ round($discount) }}%</span>
                                                    @endif
                                                            </td>

                                                            <td> @if($product->status == 1)
                                                                    <span class="badge rounded-pill bg-success">Active</span>
                                                                    @else
                                                                    <span class="badge rounded-pill bg-danger">InActive</span>
                                                                    @endif
                                                                </td>
                                                <td>
                                                    <a class="btn btn-primary " href="{{ route('edit.product',$product->id) }}" title="Edit Data"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <a class="btn btn-danger  deleted" href="{{ route('oneProduct.delete',$product->id) }}" title="Delete Data"><i class="fa-solid fa-trash"></i></a>
                                                    <a href="" class="btn btn-warning" title="Details Page"> <i class="fa fa-eye"></i> </a>

                                                    @if($product->status == 1)
                                                    <a href="{{ route('product.inactive', $product->id) }}" class="btn btn-primary" title="Inactive"> <i class="fa-solid fa-thumbs-down"></i> </a>
                                                    @else
                                                    <a href="{{ route('product.active', $product->id) }}" class="btn btn-primary" title="Active"> <i class="fa-solid fa-thumbs-up"></i> </a>
                                                    @endif
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

