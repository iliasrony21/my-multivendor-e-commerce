
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Amader shop</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend')}}/assets/imgs/theme/favicon.svg" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/plugins/animate.min.css" />
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/main.css?v=5.3" />
</head>

<body>
    <!-- Modal -->

    <!-- Quick view -->
   @include('frontend.main.quickview')
    <!-- Header  -->
    @include('frontend.main.header')

   <!-- End Header  -->

    <!--End header-->


<main class="main">
@yield('userFrontEnd')
</main>







    @include('frontend.main.footer')
    <!-- Preloader Start -->
    @include('frontend.main.preloader')
    <!-- Vendor JS-->
    <script src="{{ asset('frontend') }}/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/slick.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/waypoints.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/wow.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/magnific-popup.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/select2.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/counterup.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/images-loaded.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/isotope.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/scrollup.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.vticker-min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.theia.sticky.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.elevatezoom.js"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend') }}/assets/js/main.js?v=5.3"></script>
    <script src="{{ asset('frontend') }}/assets/js/shop.js?v=5.3"></script>

    <script type="text/javascript">

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
    /// Start product view with Modal

    function productView(id){
        $.ajax({
            type:'GET',
            url:'/product/view/modal/'+id,
            dataType:'json',
            success:function(data){
                $('#pname').text(data.product.product_name);
        $('#pprice').text(data.product.selling_price);
        $('#pcode').text(data.product.product_code);
        $('#pcategory').text(data.product.category.category_name);
        $('#pbrand').text(data.product.brand.brand_name);
        $('#pimage').attr('src','/'+data.product.product_thumbnail);

        //product price
        if(data.product.discount_price == null){
            $('#pprice').text('');
            $('#oldprice').text('');
            $('#pprice').text(data.product.discount_price);
        }
        else{
            $('#oldprice').text(data.product.discount_price);
            $('#pprice').text(data.product.discount_price);

        }

        if(data.product.product_qty >0){
            $('#available').text('');
            $('#stockout').text('');
            $('#available').text('Available');

        }
        else{
            $('#available').text('');
            $('#stockout').text('');
            $('#stockout').text('stockout');

        }

        //size part
        $('select[name="size"]').empty();
        $.each(data.size,function(key,value){
            $('select[name="size"]').append('<option value="'+value+'">'+value+'</option>')
            if(data.size == ''){
                $('#sizeArea').hide();

            }
            else{
                $('#sizeArea').show();

            }
        })

        //color part
        $('select[name="color"]').empty();
        $.each(data.color,function(key,value){
            $('select[name="color"]').append('<option value="'+value+'" >'+value+'</option>')
            if(data.color == ''){
                $('#colorArea').hide();
            }
            else{
                $('#colorArea').show();
            }

        })
            }



        });

    }
 </script>
</body>

</html>
