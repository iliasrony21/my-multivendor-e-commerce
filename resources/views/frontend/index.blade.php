@extends('frontend.master')
@section('userFrontEnd')

@section('title')
Home Rony's Shop
@endsection

       @include('frontend.index.slider')
        <!--End hero slider-->
        @include('frontend.index.catslider')
        <!--End category slider-->
        @include('frontend.index.banner')
        <!--End banners-->

        @include('frontend.index.producttab')
        <!--Products Tabs-->


        @include('frontend.index.bestsale')
        <!--End Best Sales-->



        <!-- Fashion Category -->

        <section class="product-tabs section-padding position-relative">
            <div class="container">
                <div class="section-title style-2 wow animate__animated animate__fadeIn">
                    <h3>{{ $skip_category_1->category_name }} Category </h3>

                </div>
                <!--End nav-tabs-->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">



                        @foreach($skip_product_1 as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ asset($product->product_thumbnail) }}" alt="" />

                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn"><i class="fi-rs-heart" id="{{$product->id}}" onclick="addToWishlist(this.id)"></i></a>
                                            <a aria-label="Compare" class="action-btn"id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                            <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"  id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                        </div>
                                        @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount/$product->selling_price)*100;
                                        @endphp

                                        <div class="product-badges product-badges-position product-badges-mrg">
                                        @if($product->discount_price == NULL)
                                        <span class="new">New</span>
                                        @else
                                            <span class="hot">{{ round($discount) }}%</span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></h2>
                                        <div class="product-rate-cover">

                                        @php
                                        $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                        $avarage = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                        @endphp
                                            <div class="product-rate d-inline-block">
                                            @if($avarage == 0)

                                                @elseif($avarage == 1 || $avarage < 2)
                                                <div class="product-rating" style="width: 20%"></div>
                                                @elseif($avarage == 2 || $avarage < 3)
                                                <div class="product-rating" style="width: 40%"></div>
                                                @elseif($avarage == 3 || $avarage < 4)
                                                <div class="product-rating" style="width: 60%"></div>
                                                @elseif($avarage == 4 || $avarage < 5)
                                                <div class="product-rating" style="width: 80%"></div>
                                                @elseif($avarage == 5 || $avarage < 5)
                                                <div class="product-rating" style="width: 100%"></div>
                                                @endif
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                                        </div>
                                        @if($product->vendor_id == NULL)
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">Admin</a></span>
                                        @else
                                        <div>
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $product['vendor']['name'] }}</a></span>
                                        </div>
                                        @endif
                                        <div class="product-card-bottom">
                                            @if($product->discount_price == NULL)
                                            <div class="product-price">
                                                <span>$ {{ $product->selling_price }}</span>

                                            </div>
                                            @else

                                            <div class="product-price">
                                                <span>$ {{ $product->discount_price }}</span>
                                                <span class="old-price">${{ $product->selling_price }}</span>
                                            </div>
                                            @endif
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!--end product card-->



                        </div>
                        <!--End product-grid-4-->
                    </div>


                </div>
                <!--End tab-content-->
            </div>


      </section>

        <!--End fashion Category -->


        <!-- Furniture Category -->

        <section class="product-tabs section-padding position-relative">
            <div class="container">
                <div class="section-title style-2 wow animate__animated animate__fadeIn">
                    <h3>{{ $skip_category_4->category_name }} Category </h3>

                </div>
                <!--End nav-tabs-->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">



                        @foreach($skip_product_4 as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ asset($product->product_thumbnail) }}" alt="" />

                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn"><i class="fi-rs-heart" id="{{$product->id}}" onclick="addToWishlist(this.id)"></i></a>
                                            <a aria-label="Compare" class="action-btn"id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                            <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"  id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                        </div>
                                        @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount/$product->selling_price)*100;
                                        @endphp

                                        <div class="product-badges product-badges-position product-badges-mrg">
                                        @if($product->discount_price == NULL)
                                        <span class="new">New</span>
                                        @else
                                            <span class="hot">{{ round($discount) }}%</span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></h2>
                                        <div class="product-rate-cover">

                                        @php
                                        $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                        $avarage = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                        @endphp
                                            <div class="product-rate d-inline-block">
                                            @if($avarage == 0)

                                            @elseif($avarage == 1 || $avarage < 2)
                                            <div class="product-rating" style="width: 20%"></div>
                                            @elseif($avarage == 2 || $avarage < 3)
                                            <div class="product-rating" style="width: 40%"></div>
                                            @elseif($avarage == 3 || $avarage < 4)
                                            <div class="product-rating" style="width: 60%"></div>
                                            @elseif($avarage == 4 || $avarage < 5)
                                            <div class="product-rating" style="width: 80%"></div>
                                            @elseif($avarage == 5 || $avarage < 5)
                                            <div class="product-rating" style="width: 100%"></div>
                                            @endif
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                                        </div>
                                        @if($product->vendor_id == NULL)
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">Admin</a></span>
                                        @else
                                        <div>
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $product['vendor']['name'] }}</a></span>
                                        </div>
                                        @endif
                                        <div class="product-card-bottom">
                                            @if($product->discount_price == NULL)
                                            <div class="product-price">
                                                <span>$ {{ $product->selling_price }}</span>

                                            </div>
                                            @else

                                            <div class="product-price">
                                                <span>$ {{ $product->discount_price }}</span>
                                                <span class="old-price">${{ $product->selling_price }}</span>
                                            </div>
                                            @endif
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!--end product card-->



                        </div>
                        <!--End product-grid-4-->
                    </div>


                </div>
                <!--End tab-content-->
            </div>


      </section>

        <!--End Furniture Category -->


        <!-- Mobile Category -->
        <section class="product-tabs section-padding position-relative">
            <div class="container">
                <div class="section-title style-2 wow animate__animated animate__fadeIn">
                    <h3>{{ $skip_category_5->category_name }} Category </h3>

                </div>
                <!--End nav-tabs-->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">



                        @foreach($skip_product_5 as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ asset($product->product_thumbnail) }}" alt="" />

                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" ><i class="fi-rs-heart" id="{{$product->id}}" onclick="addToWishlist(this.id)"></i></a>
                                            <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                            <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"  id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                        </div>
                                        @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount/$product->selling_price)*100;
                                        @endphp

                                        <div class="product-badges product-badges-position product-badges-mrg">
                                        @if($product->discount_price == NULL)
                                        <span class="new">New</span>
                                        @else
                                            <span class="hot">{{ round($discount) }}%</span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></h2>
                                        <div class="product-rate-cover">

                                        @php
                                            $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                            $avarage = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                            @endphp
                                            <div class="product-rate d-inline-block">
                                            @if($avarage == 0)

                                                @elseif($avarage == 1 || $avarage < 2)
                                                <div class="product-rating" style="width: 20%"></div>
                                                @elseif($avarage == 2 || $avarage < 3)
                                                <div class="product-rating" style="width: 40%"></div>
                                                @elseif($avarage == 3 || $avarage < 4)
                                                <div class="product-rating" style="width: 60%"></div>
                                                @elseif($avarage == 4 || $avarage < 5)
                                                <div class="product-rating" style="width: 80%"></div>
                                                @elseif($avarage == 5 || $avarage < 5)
                                                <div class="product-rating" style="width: 100%"></div>
                                                @endif
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                                        </div>
                                        @if($product->vendor_id == NULL)
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">Admin</a></span>
                                        @else
                                        <div>
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $product['vendor']['name'] }}</a></span>
                                        </div>
                                        @endif
                                        <div class="product-card-bottom">
                                            @if($product->discount_price == NULL)
                                            <div class="product-price">
                                                <span>$ {{ $product->selling_price }}</span>

                                            </div>
                                            @else

                                            <div class="product-price">
                                                <span>$ {{ $product->discount_price }}</span>
                                                <span class="old-price">${{ $product->selling_price }}</span>
                                            </div>
                                            @endif
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!--end product card-->



                        </div>
                        <!--End product-grid-4-->
                    </div>


                </div>
                <!--End tab-content-->
            </div>


      </section>

        <!--Mobile Category -->




        @include('frontend.index.columnlist')
        <!--End 4 columns-->









  <!--Vendor List -->

@include('frontend.index.vendor')


 <!--End Vendor List -->

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
