@extends('admin.master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">All Return Order</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Return Order</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">

						</div>
					</div>
				</div>
				<!--end breadcrumb-->

				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
			<tr>
				<th>Sl</th>
				<th>Date </th>
				<th>Invoice </th>
				<th>Amount </th>
				<th>Payment </th>
				<th>State </th>
				<th>Reason </th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
	@foreach($orders as $key => $item)
			<tr>
				<td> {{ $key+1 }} </td>
				<td>{{ $item->order_date }}</td>
				<td>{{ $item->invoice_no }}</td>
				<td>${{ $item->amount }}</td>
				<td>{{ $item->payment_method }}</td>
                <td>

                @if($item->return_order == 1)
      <span class="badge rounded-pill bg-danger"> Pending </span>
      			@elseif($item->return_order == 2)
      <span class="badge rounded-pill bg-success"> Success </span>
               @endif
  	         </td>

  	         <td>{{ $item->return_reason }}</td>

				<td>
<a href="{{ route('admin.order.details',$item->id) }}" class="btn btn-info" title="Details"><i class="fa fa-eye"></i> </a>

<a href="{{ route('return.request.approved',$item->id) }}" class="btn btn-danger approved" title="Approved" id="approved"><i class="fa-solid fa-person-circle-check"></i> </a>
				</td>
			</tr>
			@endforeach


		</tbody>
		<tfoot>
			<tr>
				<th>Sl</th>
				<th>Date </th>
				<th>Invoice </th>
				<th>Amount </th>
				<th>Payment </th>
				<th>State </th>
				<th>Reason </th>
				<th>Action</th>
			</tr>
		</tfoot>
	</table>
						</div>
					</div>
				</div>



			</div>
<script>
            // Return Approved Order
$(function(){
    $(document).on('click','.approved',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure to Approved?',
                    text: "Return Order Approved",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Approved!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Approved!',
                        'Approved Change',
                        'success'
                      )
                    }
                  })


    });
    </script>

@endsection
