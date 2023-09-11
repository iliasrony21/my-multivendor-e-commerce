@extends('master')
@section('user')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> user Order page
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
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
            <h3 class="mb-0">Your Orders</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" style="background:#ddd;font-weight: 600;">
                    <thead>
                    <tr>
                            <th>Sl</th>
                            <th>Date</th>
                            <th>Totally</th>
                            <th>Payment</th>
                            <th>Invoice</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key=> $order)
        <tr>
            <td>{{ $key+1 }}</td>
            <td> {{ $order->order_date }}</td>
           <td> ${{ $order->amount }}</td>
            <td> {{ $order->payment_method }}</td>
            <td> {{ $order->invoice_no }}</td>
            <td>
            @if($order->status == 'pending')
            <span class="badge rounded-pill bg-warning">Pending</span>
            @elseif($order->status == 'confirm')
            <span class="badge rounded-pill bg-info">Confirm</span>
            @elseif($order->status == 'processing')
            <span class="badge rounded-pill bg-dark">Processing</span>
            @elseif($order->status == 'delivered')
            <span class="badge rounded-pill bg-success">Delivered</span>
            @endif
            @if($order->return_order == 1)
<span class="badge rounded-pill" style="background:red;">Return</span>
@endif

            </td>


     <td><a href="{{ url('user/order_details/'.$order->id) }}" class="btn-sm btn-success"><i class="fa fa-eye"></i> View</a>
     <a href="{{ url('user/invoice_download/'.$order->id) }}" class="btn-sm btn-danger"><i class="fa fa-download"></i> Invoice</a>
            </td>
        </tr>
        @endforeach
                    </tbody>
                </table>
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
        </div>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
        }
 @endif
</script>


@endsection