@extends('admin.master')
  @section('admin')
  <script src="{{asset('backend')}}/assets/js/jquery.min.js"></script>
  <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Add SubCategory</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">SubCategory</li>
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

							<div class="col-lg-8 offset-2">
                                <div class="card">
									<div class="card-body">
                                    <form class="form" action="{{route('subcategory.store')}}" method="POST" enctype="multipart/form-data" >
								      @csrf
                                      <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Category Name</h6>
											</div>
											<div class="col-sm-9 text-secondary msg">

                                            <select name="category_id" id="">
                                                <option value="">----select category----</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            </div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">SubCategory Name</h6>
											</div>
											<div class="col-sm-9 text-secondary msg">
												<input type="text" name="subcategory_name" id="subcategory_name" class="form-control @error('subcategory_name') is-invalid @enderror" placeholder="subCategory Name" value="" />

                                            </div>
										</div>

                                        <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Choose Subcategory Image</h6>
											</div>
											<div class="col-sm-9 text-secondary msg">
                                            <input type="file" name="subcategory_image" id="subcategory_image" class="form-control subcategory_image" value="" />
											<img id="imagepre" src="{{ asset('uploads/empty.jpg') }}" alt="subcategory" height="150" width="150">

											</div>
										</div>



										<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9 text-secondary">
												<input type="submit" class="btn btn-primary px-4" value="Save Category" />
											</div>
										</div>
									</div>
                                    </form>
								</div>


							</div>
						</div>
					</div>
				</div>
			</div>
            <script>
                'use strict'
                jQuery(document).ready(function(){
                    jQuery(".subcategory_image").change(function(e){
                    var filereader = new FileReader();
                    filereader.onload = function(e){
                        jQuery('#imagepre').attr('src',e.target.result);
                    }
                    filereader.readAsDataURL(e.target.files['0']);
                    })

                })
            </script>
            <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery(".form").validate({
                        rules:{
                            subcategory_name:{
                                required:true,
                            },
                            subcategory_image:{
                                required:true,
                            },
                        },
                        messages:{
                            subcategory_name:{
                                required:'subcategory name is Empty',

                            },
                            subcategory_image:{
                                required:'subcategory image is Empty',

                            },
                        },
                        errorElement: 'span',
                        errorPlacement:function(error,element){
                            error.addClass('invalid-feedback');
                            element.closest('.msg').append(error);
                        },
                        highlight:function(element,errorClass,validClass){
                            jQuery(element).addClass("is-invalid");
                        },
                        unhighlight:function(element,errorClass,validClass){
                            jQuery(element).removeClass("is-invalid");
                        },

                    })
                })

            </script>
            @endSection

