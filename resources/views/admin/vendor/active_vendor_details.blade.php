@extends('admin.master')
  @section('admin')
  <script src="{{asset('backend')}}/assets/js/jquery.min.js"></script>
  <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Inactive Vendor Details</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Inactive Vendor Details</li>
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

                                <div class="card">
									<div class="card-body">
                                    <form action="{{ route('vendor.inactivate.approve') }}" method="POST">
								      @csrf

									  <input type="hidden" name="id" value="{{ $activeVendorDetails->id }}">

										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Shop Name</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" name="name" class="form-control" value="{{$activeVendorDetails->name}}" />
											</div>
										</div>
                                        <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Name</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" name="userName" class="form-control" value="{{$activeVendorDetails->userName}}" />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Email</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" name="email" class="form-control" value="{{$activeVendorDetails->email}}" />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Phone</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" name="phone" class="form-control" value="{{$activeVendorDetails->phone}}" />
											</div>
										</div>

										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Address</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" name="address" class="form-control" value="{{$activeVendorDetails->address}}" />
											</div>
										</div>
                                        <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Vendor Join Date</h6>
											</div>
											<div class="col-sm-9">

                                                <input type="datetime-local" name="vendor_join" value="{{$activeVendorDetails->vendor_join}}" class="form-control">
                                             </div>
										</div>
                                        <div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Vendor Info</h6>
											</div>
											<div class="col-sm-9 text-secondary">
                                            <textarea class="form-control" name="vendor_short_info"   id="vendor_short_info" placeholder="vendor description" rows="3"> {{ $activeVendorDetails->vendor_short_info }}</textarea>											</div>

                                        </div>

										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">vendor Image</h6>
											</div>
											<div class="col-sm-9 text-secondary">

                                                <img id="image" src="{{ (!empty('$activeVendorDetails->profile_pic')) ? asset('uploads/vendor/'.$activeVendorDetails->profile_pic):asset('uploads/empty.jpg') }}" alt="vendor" height="120" width="120">
											</div>
										</div>
										<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9 text-secondary">
												<input type="submit" class="btn btn-danger px-4" value="Inactive Vendor" />
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


@endSection
