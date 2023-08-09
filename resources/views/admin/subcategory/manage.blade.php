@extends('admin.master')
  @section('admin')
  <script src="{{asset('backend')}}/assets/js/jquery.min.js"></script>
  <div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Manage All subcategories</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All subcategories</li>
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
                                                <th>category Name</th>
                                                <th>subcategory Name </th>
                                                <th>subcategory Slug </th>
                                                <th>subcategory image </th>
                                                <th>Status </th>
                                                <th>Action </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($subcategories) > 0)
                                                @foreach($subcategories as $subcategory)
                                               <tr>
                                               <td>{{ $subcategory->id }}</td>
                                               <td>{{ $subcategory->cat->category_name }}</td>

                                                <td>{{ $subcategory->subcategory_name }} </td>
                                                <td>{{ $subcategory->subcategory_slug }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/subcategory/'.$subcategory->subcategory_image) }}" alt="subcategory Image" height="120" width="120">
                                                </td>
                                                <td>{{ $subcategory->status }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="{{ route('subcategory.edit',$subcategory->id) }}">Edit</a>
                                                    <a class="btn btn-danger btn-sm deleted" href="{{ route('subcategory.delete',$subcategory->id) }}">Delete</a>
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
                                                <th>category Name</th>
                                                <th>subcategory Name</th>
                                                <th>subcategory Slug</th>
                                                <th>subcategory image</th>
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


            @endSection

