@extends('master')
@section('user')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> User Account Details
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto">
<div class="row">

<!-- // Start Col md 3 menu -->

@include('frontend.main.dashboard_sidebar_menu')
<!-- // End Col md 3 menu -->




<div class="col-md-9">
<div class="tab-content account dashboard-content pl-50">
<div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
 <div class="card">
        <div class="card-header">
            <h5>Account Details</h5>
        </div>
        <div class="card-body">



    <form method="post" action="{{ route('user.update.profile') }}" enctype="multipart/form-data" >
            @csrf


            <div class="row">
                <div class="form-group col-md-6">
                    <label>Full Name <span class="required">*</span></label>
                    <input required="" class="form-control" name="name" type="text" value="{{ $userData->name }}" />
                </div>
                <div class="form-group col-md-6">
                    <label>user Name <span class="required">*</span></label>
                    <input required="" class="form-control" name="userName"value="{{ $userData->userName }}" />
                </div>

                <div class="form-group col-md-12">
                    <label>Email Address <span class="required">*</span></label>
                    <input required="" class="form-control" name="email" type="email" value="{{ $userData->email }}"/>
                </div>

                <div class="form-group col-md-12">
                    <label>Phone Number <span class="required">*</span></label>
                    <input required="" class="form-control" name="phone" type="text" value="{{ $userData->phone }}"/>
                </div>
                <div class="form-group col-md-12">
                    <label>Address <span class="required">*</span></label>
                    <input required="" class="form-control" name="address" type="text" value="{{ $userData->address }}" />
                </div>
                <div class="form-group col-md-12">
                    <input required="" class="form-control image" name="image" type="file"/>
                    <img id="imagepre" src="{{ (!empty($userData->profile_pic))? asset('uploads/user/'.$userData->profile_pic) : asset('uploads/user/user.png') }}" alt="" height="150" width="150">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

  </div>
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



@endsection
