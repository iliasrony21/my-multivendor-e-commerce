@extends('admin.master')
  @section('admin')
  <script src="{{asset('backend')}}/assets/js/jquery.min.js"></script>
  <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Manage All brand</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Brands</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">

							<div class="col-lg-12">
                                <!-- @if(session('successstatus'))
                                <div class="alert alert-success">{{ session('successstatus') }}</div>
                                @elseif(session('error'))
                                <div class="alert alert-warning">{{ session('error') }}</div>
                                @endif -->

                                <div class="card">
									<div class="card-body">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>

                                            <tr>
                                                <th>#sl</th>
                                                <th>Brand Name </th>
                                                <th>Brand Slug </th>
                                                <th>Brand image </th>
                                                <th>Status </th>
                                                <th>Action </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($brands) > 0)
                                                @foreach($brands as $brand)
                                               <tr>
                                               <td>{{ $brand->id }}</td>
                                                <td>{{ $brand->brand_name }} </td>
                                                <td>{{ $brand->brand_slug }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/brand/'.$brand->brand_image) }}" alt="brand Image" height="120" width="120">
                                                </td>
                                                <td>{{ $brand->status }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="{{ route('brand.edit',$brand->id) }}">Edit</a>
                                                    <a class="btn btn-danger btn-sm deleted" href="{{ route('brand.delete',$brand->id) }}">Delete</a>
                                                </td>
                                               </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td class="text-center text-warning"> Data not found</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>#sl</th>
                                                <th>Brand Name</th>
                                                <th>Brand Slug</th>
                                                <th>Brand image</th>
                                                <th>Status</th>
                                                <th>Action</th>
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

