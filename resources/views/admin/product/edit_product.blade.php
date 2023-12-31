@extends('admin.master')
@section('admin')
<script src="{{asset('backend')}}/assets/js/jquery.min.js"></script>

<div class="page-content">

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Edit Product</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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

<div class="card">
  <div class="card-body p-4">
      <h5 class="card-title">Edit Product</h5>
      <hr/>

      <form id="myForm" method="post" action="{{ route('update.product') }}"  >
			@csrf

		<input type="hidden" name="id" value="{{ $products->id }}">

       <div class="form-body mt-4">
        <div class="row">
           <div class="col-lg-8">
           <div class="border border-3 p-4 rounded">


            <div class="form-group mb-3">
                <label for="inputProductTitle" class="form-label" >Product name</label>
                <input type="text" name="product_name" class="form-control" id="inputProductTitle" value="{{ $products->product_name }}">              </div>
              <div class="mb-3">
                <label for="inputProductTitle" class="form-label">Product tags</label>
                <input type="text" name="product_tags" class="form-control" data-role="tagsinput" value="{{ $products->product_tags }}">
              </div>
              <div class="mb-3">
                <label for="inputProductTitle" class="form-label">Product size</label>
                <input type="text" name="product_size" class="form-control" data-role="tagsinput" value="{{ $products->product_size }}">
              </div>
              <div class="mb-3">
                <label for="inputProductTitle" class="form-label">Product color</label>
                <input type="text" name="product_color" class="form-control" data-role="tagsinput" value="{{ $products->product_color }}">
              </div>

              <div class="form-group mb-3">
                <label for="inputProductDescription" class="form-label">Short Description</label>
                <textarea class="form-control" name="short_descp" id="inputProductDescription" rows="3">{{ $products->short_descp }}</textarea>
              </div>
              <div class="mb-3">
                <label for="inputProductDescription" class="form-label">Long Description</label>

				<textarea id="mytextarea" name="long_descp">{{ $products->long_descp }}</textarea>
				</div>

            </div>
           </div>
           <div class="col-lg-4">
            <div class="border border-3 p-4 rounded">
              <div class="row g-3">
                <div class="form-group col-md-6">
                    <label for="inputPrice" class="form-label">Product Price</label>
                    <input type="text" class="form-control" name="selling_price" id="inputPrice" value="{{ $products->selling_price }}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputCompareatprice" class="form-label">Discount Price</label>
                    <input type="text" class="form-control" name="discount_price" id="inputCompareatprice" value="{{ $products->discount_price }}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputCostPerPrice" class="form-label">Product code</label>
                    <input type="text" class="form-control" name="product_code" id="inputCostPerPrice" value="{{ $products->product_code }}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputStarPoints" class="form-label">Product Quantity</label>
                    <input type="text" class="form-control" name="product_qty" id="inputStarPoints" value="{{ $products->product_qty }}">
                  </div>
                  <div class="form-group col-12">
                    <label for="inputProductType" class="form-label">Product Brand</label>
                    <select class="form-select" name="brand_id" id="inputProductType">
                        <option></option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == $products->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group col-12">
                    <label for="inputProductType" class="form-label">Product Category</label>
                    <select class="form-select" name="category_id" id="inputProductType">
                        <option></option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $products->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group col-12">
                    <label for="inputProductType" class="form-label">Product subcategory</label>
                    <select name="subcategory_id" class="form-select" id="inputCollection">
						<option></option>
						@foreach($subcategories as $subcat)
						<option value="{{ $subcat->id }}" {{ $subcat->id == $products->subcategory_id ? 'selected' : '' }}>{{ $subcat->subcategory_name }}</option>
						 @endforeach

					  </select>
                  </div>
                  <div class="form-group col-12">
                    <label for="inputVendor" class="form-label">Selected Vendor</label>
                    <select class="form-select" name="vendor_id" id="inputVendor">
                        <option></option>
                        @foreach($active_vendor as $vendors)
                        <option value="{{ $vendors->id }}" {{ $vendors->id == $products->vendor_id ? 'selected' : '' }}>{{ $vendors->name }}</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="col-12">
                    <div class="row g-3">
                        <div class="col-md-6">
                          <input class="form-check-input" name="hot_deals" type="checkbox" id="flexSwitchCheckDefault" value="1"  {{ $products->hot_deals == 1 ? 'checked' : '' }} >
                          <label class="form-check-label" for="flexSwitchCheckDefault">Hot Deals</label>
                        </div>
                        <div class="col-md-6">
                          <input class="form-check-input" name="featured" type="checkbox" id="flexSwitchCheckDefault" value="1"  {{ $products->featured == 1 ? 'checked' : '' }} >
                          <label class="form-check-label" for="flexSwitchCheckDefault">Featured Product</label>

                        </div>
                        <div class="col-md-6">
                          <input class="form-check-input" name="special_offer" type="checkbox" id="flexSwitchCheckDefault" value="1"  {{ $products->special_offer == 1 ? 'checked' : '' }} >
                          <label class="form-check-label" for="flexSwitchCheckDefault">Special offer</label>

                        </div>
                        <div class="col-md-6">
                          <input class="form-check-input" name="special_deals" type="checkbox" id="flexSwitchCheckDefault" value="1"  {{ $products->special_deals == 1 ? 'checked' : '' }} >
                          <label class="form-check-label" for="flexSwitchCheckDefault">Special Deals</label>

                        </div>
                        <hr>
                  </div>
                </div>
                  <div class="col-12">
                      <div class="d-grid">
                      <input type="submit" class="btn btn-primary px-4" value="Save Changes" />                      </div>
                  </div>
              </div>
          </div>
          </div>
       </div><!--end row-->
    </div>
  </div>
</form>
</div>

</div>

<!-- Main Image -->
             <div class="page-content">
                  <h6 class="mb-2 text-uppercase">Update Main Image Thumbnail</h6>
                        <div class="card">
                    <form  method="post" action="{{ route('update.product.thumbnail') }}" enctype="multipart/form-data"  >
			            @csrf

		                 <input type="hidden" name="id" value="{{ $products->id }}">
		                 <input type="hidden" name="old_img" value="{{ $products->product_thumbnail }}">
							<div class="card-body">
								<div class="mb-3">
									<label for="formFile" class="form-label">Choose Thumbnail Image</label>
									<input class="form-control" name="product_thumbnail" type="file" id="formFile">
								</div>
								<div class="mb-3">
                                    <label for="formFile" class="form-label"></label>
                                    <img src="{{ asset($products->product_thumbnail) }}" style="width:100px; height:100px" alt="">
								</div>
                                <input type="submit" class="btn btn-primary px-4" value="Save Changes" />                      </div>


							</div>
                    </form>
						</div>
                        <!-- /// Update Multi Image  ////// -->

<div class="page-content">
	<h6 class="mb-0 text-uppercase">Update Multi Image </h6>
	<hr>
<div class="card">
<div class="card-body">
	<table class="table mb-0 table-striped">
		<thead>
			<tr>
				<th scope="col">#Sl</th>
				<th scope="col">Image</th>
				<th scope="col">Change Image </th>
				<th scope="col">Delete </th>
			</tr>
		</thead>
		<tbody>

 <form method="post" action="{{ route('update.product.multiimg') }}" enctype="multipart/form-data" >
			@csrf

	@foreach($multiImgs as $key => $img)
	<tr>
		<th scope="row">{{ $key+1 }}</th>
		<td> <img src="{{ asset($img->photo_name) }}" style="width:70; height: 40px;"> </td>
		<td> <input type="file" class="form-group" name="multi_img[{{ $img->id }}]"> </td>
		<td>
	<input type="submit" class="btn btn-primary px-4" value="Update Image " />
	<a href="{{ route('update.product.delete',$img->id) }}" class="btn btn-danger deleted" id="deleted"> Delete </a>
		</td>
	</tr>
	@endforeach

		</form>
		</tbody>
	</table>
</div>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                product_name: {
                    required : true,
                },
                 short_descp: {
                    required : true,
                },
                 product_thambnail: {
                    required : true,
                },
                 multi_img: {
                    required : true,
                },
                 selling_price: {
                    required : true,
                },
                 product_code: {
                    required : true,
                },
                 product_qty: {
                    required : true,
                },
                 brand_id: {
                    required : true,
                },
                 category_id: {
                    required : true,
                },
                 subcategory_id: {
                    required : true,
                },
            },
            messages :{
                product_name: {
                    required : 'Please Enter Product Name',
                },
                short_descp: {
                    required : 'Please Enter Short Description',
                },
                product_thumbnail: {
                    required : 'Please Select Product Thumbnail Image',
                },
                multi_img: {
                    required : 'Please Select Product Multi Image',
                },
                selling_price: {
                    required : 'Please Enter Selling Price',
                },
                product_code: {
                    required : 'Please Enter Product Code',
                },
                 product_qty: {
                    required : 'Please Enter Product Quantity',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>



<script>

function mainThumbUrl(input){
  if(input.files && input.files[0]){
    var reader = new FileReader();
    reader.onload = function(e){
      $('#mainThumb').attr('src', e.target.result).width(100).height(100);

    }
    reader.readAsDataURL(input.files[0]);
  }
}

</script>
<script>

  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data

          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                  .height(80); //create image element
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });

      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });

  </script>
  <!-- //category te select korle automatic category ar under a jegulo subcategory ase segulo dekhabe -->

  <script>
    $(document).ready(function(){
      $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();
        if(category_id){

          $.ajax({
            url: "{{ url('/subcategory/ajax') }}/"+category_id,
            type:"GET",
            dataType:"json",
            success:function(data){
              $('select[name="subcategory_id"]').html('');
              var d = $('select[name="subcategory_id"]').empty();
              $.each(data, function(key,value){
                $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name + '</option>')
              });
            },
          });

        }else{
          alert('there is a problem');
        }
      })
    })
  </script>
@endsection
