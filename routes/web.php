<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\VendorProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated as MiddlewareRedirectIfAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('frontend.index');
// });

Route::get('/', [IndexController::class, 'Index']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//////////////////////////////////
           //user route
///////////////////////////////////

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::post('user/update/profile', [UserController::class, 'updateProfile'])->name('user.update.profile');
    Route::post('/dashboard/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
});

///////All Routes for Admin ///////////////
Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('admin/change/password', [AdminController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('admin/update/password', [AdminController::class, 'updatePassword'])->name('admin.update.password');
    Route::post('admin/update/profile', [AdminController::class, 'updateProfile'])->name('admin.update.profile');

   //Brand controller
    Route::controller(BrandController::class)->group(function(){
        Route::get("Brand/add",'index')->name('brand.add');
        Route::post("Brand/store",'store')->name('brand.store');
        Route::get("Brand/manage",'manage')->name('brand.manage');
        Route::get("Brand/edit/{id}",'edit')->name('brand.edit');
        Route::post("Brand/update/{id}",'update')->name('brand.update');
        Route::get("Brand/delete/{id}",'brandDelete')->name('brand.delete');

    });

    //Category controller
    Route::controller(CategoryController::class)->group(function(){
     Route::get("Category/add",'index')->name('category.add');
     Route::post("Category/store",'store')->name('category.store');
     Route::get("Category/manage",'manage')->name('category.manage');
     Route::get("Category/edit/{id}",'edit')->name('category.edit');
     Route::post("Category/update/{id}",'update')->name('category.update');
     Route::get("Category/delete/{id}",'categoryDelete')->name('category.delete');

       });

        //Sub Category controller
        Route::controller(SubCategoryController::class)->group(function(){
        Route::get("subcategory/add",'index')->name('subcategory.add');
        Route::post("subcategory/store",'store')->name('subcategory.store');
        Route::get("subcategory/manage",'manage')->name('subcategory.manage');
        Route::get("subcategory/edit/{id}",'edit')->name('subcategory.edit');
        Route::post("subcategory/update/{id}",'update')->name('subcategory.update');
        Route::get("subcategory/delete/{id}",'subcategoryDelete')->name('subcategory.delete');
        Route::get("/subcategory/ajax/{category_id}",'GetSubcategory');



          });
          //all  product
          Route::controller(ProductController::class)->group(function(){

            Route::get("add/product",'addProduct')->name('add.product');
            Route::get("all/product",'allProduct')->name('all.product');
            Route::post("store/product",'StoreProduct')->name('store.product');
            Route::get("edit/product/{id}",'EditProduct')->name('edit.product');
            Route::post("update/product",'UpdateProduct')->name('update.product');
            Route::post("update/product/thumbnail",'UpdateProductThumbnail')->name('update.product.thumbnail');
            Route::post("update/product/multiimg",'UpdateProductMultiImg')->name('update.product.multiimg');
            Route::get("product/delete/{id}",'productDelete')->name('update.product.delete');
            Route::get("product/inactive/{id}",'productInactive')->name('product.inactive');
            Route::get("product/active/{id}",'productActive')->name('product.active');
            Route::get("product/onedeleted/{id}",'SingleProductDelete')->name('oneProduct.delete');


        });
        Route::controller(SliderController::class)->group(function(){
            Route::get('/all/slider' , 'AllSlider')->name('all.slider');
            Route::get('/add/slider' , 'AddSlider')->name('add.slider');
            Route::post('/store/slider' , 'StoreSlider')->name('store.slider');
            Route::get('/edit/slider/{id}' , 'EditSlider')->name('edit.slider');
            Route::post('/update/slider' , 'UpdateSlider')->name('update.slider');
            Route::get('/delete/slider/{id}' , 'DeleteSlider')->name('delete.slider');


        });
         // coupon All Route
Route::controller(CouponController::class)->group(function(){
    Route::get('/all/coupon' , 'AllCoupon')->name('all.coupon');
    Route::get('/add/coupon' , 'AddCoupon')->name('add.coupon');
    Route::post('/store/coupon' , 'StoreCoupon')->name('coupon.store');
    Route::get('/edit/coupon/{id}' , 'EditCoupon')->name('edit.coupon');
    Route::post('/update/coupon' , 'UpdateCoupon')->name('update.coupon');
    Route::get('/delete/coupon/{id}' , 'DeleteCoupon')->name('delete.coupon');


});
 // Shipping Division All Route
 Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/division' , 'AllDivision')->name('all.division');
    Route::get('/add/division' , 'AddDivision')->name('add.division');
    Route::post('/store/division' , 'StoreDivision')->name('store.division');
    Route::get('/edit/division/{id}' , 'EditDivision')->name('edit.division');
    Route::post('/update/division' , 'UpdateDivision')->name('update.division');
    Route::get('/delete/division/{id}' , 'DeleteDivision')->name('delete.division');
});
 // Shipping District All Route
 Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/district' , 'AllDistrict')->name('all.district');
    Route::get('/add/district' , 'AddDistrict')->name('add.district');
    Route::post('/store/district' , 'StoreDistrict')->name('store.district');
    Route::get('/edit/district/{id}' , 'EditDistrict')->name('edit.district');
    Route::post('/update/district' , 'UpdateDistrict')->name('update.district');
    Route::get('/delete/district/{id}' , 'DeleteDistrict')->name('delete.district');
});

 // Shipping State All Route
 Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/state' , 'AllState')->name('all.state');
    Route::get('/add/state' , 'AddState')->name('add.state');
    Route::post('/store/state' , 'StoreState')->name('store.state');
    Route::get('/edit/state/{id}' , 'EditState')->name('edit.state');
    Route::post('/update/state' , 'UpdateState')->name('update.state');
    Route::get('/delete/state/{id}' , 'DeleteState')->name('delete.state');

    Route::get('/district/ajax/{division_id}' , 'GetDistrict');

});
 // order controller All Route
 Route::controller(OrderController::class)->group(function(){
    Route::get('/pending/order' , 'PendingOrder')->name('pending.order');
    Route::get('/admin/order/details/{order_id}' , 'AdminOrderDetails')->name('admin.order.details');

    Route::get('/admin/confirmed/order' , 'AdminConfirmedOrder')->name('admin.confirmed.order');

    Route::get('/admin/processing/order' , 'AdminProcessingOrder')->name('admin.processing.order');

    Route::get('/admin/delivered/order' , 'AdminDeliveredOrder')->name('admin.delivered.order');
    Route::get('/pending/confirm/{order_id}' , 'PendingToConfirm')->name('pending-confirm');

    Route::get('/confirm/processing/{order_id}' , 'ConfirmToProcess')->name('confirm-processing');

    Route::get('/processing/delivered/{order_id}' , 'ProcessToDelivered')->name('processing-delivered');

    Route::get('/admin/invoice/download/{order_id}' , 'AdminInvoiceDownload')->name('admin.invoice.download');



});
 // Return Order All Route
 Route::controller(ReturnController::class)->group(function(){
    Route::get('/return/request' , 'ReturnRequest')->name('return.request');
    Route::get('/return/request/approved/{order_id}' , 'ReturnRequestApproved')->name('return.request.approved');
    Route::get('/complete/return/request' , 'CompleteReturnRequest')->name('complete.return.request');
});


 // Report All Route
 Route::controller(ReportController::class)->group(function(){

    Route::get('/report/view' , 'ReportView')->name('report.view');
    Route::post('/search/by/date' , 'SearchByDate')->name('search-by-date');
    Route::post('/search/by/month' , 'SearchByMonth')->name('search-by-month');
    Route::post('/search/by/year' , 'SearchByYear')->name('search-by-year');


    Route::get('/order/by/user' , 'OrderByUser')->name('order.by.user');
    Route::post('/search/by/user' , 'SearchByUser')->name('search-by-user');

});

 // Active user and vendor All Route
 Route::controller(ActiveUserController::class)->group(function(){

    Route::get('/all/user' , 'AllUser')->name('all-user');
    Route::get('/all/vendor' , 'AllVendor')->name('all-vendor');


});
/// Blog category All Route
Route::controller(BlogController::class)->group(function(){

    Route::get('/admin/blog/category' , 'AllBlogCategory')->name('admin.blog.category');

    Route::get('/admin/add/blog/category' , 'AddBlogCategory')->name('add.blog.category');

    Route::post('/admin/store/blog/category' , 'StoreBlogCategory')->name('store.blog.category');

    Route::get('/admin/edit/blog/category/{id}' , 'EditBlogCategory')->name('edit.blog.category');

    Route::post('/admin/update/blog/category' , 'UpdateBlogCategory')->name('update.blog.category');

    Route::get('/admin/delete/blog/category/{id}' , 'DeleteBlogCategory')->name('delete.blog.category');
});

 // Blog Post All Route
 Route::controller(BlogController::class)->group(function(){

    Route::get('/admin/blog/post' , 'AllBlogPost')->name('admin.blog.post');

     Route::get('/admin/add/blog/post' , 'AddBlogPost')->name('add.blog.post');

     Route::post('/admin/store/blog/post' , 'StoreBlogPost')->name('store.blog.post');

     Route::get('/admin/edit/blog/post/{id}' , 'EditBlogPost')->name('edit.blog.post');

     Route::post('/admin/update/blog/post' , 'UpdateBlogPost')->name('update.blog.post');

     Route::get('/admin/delete/blog/post/{id}' , 'DeleteBlogPost')->name('delete.blog.post');

   });


   // Admin Review All Route
    Route::controller(ReviewController::class)->group(function(){

    Route::get('/pending/review' , 'PendingReview')->name('pending.review');


    Route::get('/review/approve/{id}' , 'ReviewApprove')->name('review.approve');
    Route::get('/publish/review' , 'PublishReview')->name('publish.review');
    Route::get('/review/delete/{id}' , 'ReviewDelete')->name('review.delete');
   });


   // Site Setting All Route
    Route::controller(SiteSettingController::class)->group(function(){

    Route::get('/site/setting' , 'SiteSetting')->name('site.setting');
    Route::post('/site/setting/update' , 'SiteSettingUpdate')->name('site.setting.update');

   });


});
//Admin group route end

Route::get('admin/login',[AdminController::class,'login'])->name('admin.login')->middleware(MiddlewareRedirectIfAuthenticated::class);
//Admin all route end


///////All Routes for vendor ///////////////
Route::middleware('auth', 'role:vendor')->group(function () {
    Route::get('vendor/dashboard', [VendorController::class, 'index'])->name('vendor.dashboard');
    Route::post('vendor/logout', [VendorController::class, 'logout'])->name('vendor.logout');
    Route::get('vendor/profile', [VendorController::class, 'profile'])->name('vendor.profile');
    Route::get('vendor/change/password', [VendorController::class, 'changePassword'])->name('vendor.changePassword');
    Route::post('vendor/update/password', [VendorController::class, 'updatePassword'])->name('vendor.update.password');
    Route::post('vendor/update/profile', [VendorController::class, 'updateProfile'])->name('vendor.update.profile');

    Route::controller(VendorProductController::class)->group(function(){
        Route::get("vendor/all/product",'VendorAllProduct')->name('vendor.allproduct');
        Route::get("vendor/add/product",'VendorAddProduct')->name('vendor.add.product');
        Route::get('/vendor/edit/product/{id}' , 'VendorEditProduct')->name('vendor.edit.product');
        Route::post('/vendor/update/product/thumbnail' , 'VendorUpdateProductThumbnail')->name('vendor.update.product.thumbnail');

        Route::post('/vendor/update/product/multiimage' , 'VendorUpdateProductmultiImage')->name('vendor.update.product.multiimage');

        Route::get('/vendor/product/multiimg/delete/{id}' , 'VendorMultiimgDelete')->name('vendor.product.multiimg.delete');
        Route::get('/vendor/product/inactive/{id}' , 'VendorProductInactive')->name('vendor.product.inactive');
        Route::get('/vendor/product/active/{id}' , 'VendorProductActive')->name('vendor.product.active');

        Route::get('/vendor/delete/product/{id}' , 'VendorProductDelete')->name('vendor.delete.product');
        Route::post('/vendor/update/product' , 'VendorUpdateProduct')->name('vendor.update.product');
        Route::post("vendor/store/product",'VendorStoreProduct')->name('vendor.store.product');
        Route::get("vendor/subcategory/ajax/{category_id}",'VendorGetSubCategory');

    });
     //vendor order  All Route
 Route::controller(VendorOrderController::class)->group(function(){
    Route::get('/vendor/order' , 'VendorOrder')->name('vendor.order');
    Route::get('/vendor/return/order' , 'VendorReturnOrder')->name('vendor.return.order');
    Route::get('/vendor/complete/return/order' , 'VendorCompleteReturnOrder')->name('vendor.complete.return.order');
    Route::get('/vendor/order/details/{order_id}' , 'VendorOrderDetails')->name('vendor.order.details');


});
Route::controller(ReviewController::class)->group(function(){

    Route::get('/vendor/all/review' , 'VendorAllReview')->name('vendor.all.review');

   });

});
Route::get('vendor/login',[VendorController::class,'login'])->name('vendor.login')->middleware(MiddlewareRedirectIfAuthenticated::class);
Route::get('become/vendor',[VendorController::class,'become_vendor'])->name('become.vendor');
Route::post('vendor/registration',[VendorController::class,'vendorRegistration'])->name('vendor.registration');



//Active and inactive vendors
Route::controller(AdminController::class)->group(function(){
    Route::get("inactive/vendor",'inactive')->name('vendor.inactive');
    Route::get("active/vendor",'active')->name('vendor.active');
    Route::get("inactive/vendor/details/{id}",'inactive_vendor_details')->name('inactive_vendor_details');
    Route::get("active/vendor/details/{id}",'active_vendor_details')->name('active.vendor.details');
    Route::post("active/vendor/approved",'activeVendorApproved')->name('vendor.activate.approve');
    Route::post("inactive/vendor/approved",'inactiveVendorApproved')->name('vendor.inactivate.approve');

      });

    //   Frontend product details
    Route::get('/product/details/{id}/{slug}', [IndexController::class, 'productDetails']);
    Route::get('/vendor/details/{id}', [IndexController::class, 'vendorDetails'])->name('vendor_details');
    Route::get('/vendor/all', [IndexController::class, 'vendorAll'])->name('vendor_all');
    Route::get('/category/details/{id}/{slug}', [IndexController::class, 'catViewDetails']);
    Route::get('/subcategory/details/{id}/{slug}', [IndexController::class, 'subCatViewDetails']);
    Route::get('/product/view/modal/{id}', [IndexController::class, 'productViewModal']);
// Add to cart store
    Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
//mini cart get data

    Route::get('/product/mini/cart', [CartController::class, 'AddToMiniCart']);
//remove mini cart
    Route::get('/product/remove/minicart/{rowId}', [CartController::class, 'removeMiniCart']);
// Details Add to cart store
Route::post('/dcart/data/store/{id}', [CartController::class, 'DetailsAddToCart']);
//add to wishlist
Route::post('/product/wishlist/{product_id}', [WishlistController::class, 'addToWishlist']);
/// Add to Compare
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);
//Apply coupon
Route::post('/Apply_coupon', [CartController::class, 'ApplyCoupon']);
//COUPON CALCULATION
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);
Route::get('/checkout', [CartController::class, 'CheckoutPage'])->name('checkout');


 // Cart All Route
 Route::controller(CartController::class)->group(function(){
    Route::get('/mycart' , 'MyCart')->name('mycart');
    Route::get('/get-cart-product' , 'GetCartProduct');
    Route::get('/cart-remove/{rowId}' , 'CartRemove');
    Route::get('/cart-decrement/{rowId}' , 'CartDecrement');
    Route::get('/cart-increment/{rowId}' , 'CartIncrement');

});

///////All Routes for user ///////////////
Route::middleware('auth', 'role:user')->group(function () {
//wishlist All route
Route::controller(WishlistController::class)->group(function(){
    Route::get("/wishlist",'wishlistPage')->name('wishlist');
    Route::get("/product/wishlist/view",'wishlistViewPage')->name('wishlistview');
    Route::get("/remove/wishlist/{id}",'wishlistRemove')->name('wishlistRemove');

      });
       // checkout district division All Route
Route::controller(CheckoutController::class)->group(function(){
    Route::get('/district-get/ajax/{division_id}' , 'DistrictGetAjax');
    Route::get('/state-get/ajax/{district_id}' , 'StateGetAjax');
    Route::post('/checkout/store' , 'CheckoutStore')->name('checkout.store');

});

       // Compare All Route
Route::controller(CompareController::class)->group(function(){
    Route::get('/compare' , 'AllCompare')->name('compare');
    Route::get('/get-compare-product' , 'GetCompareProduct');
    Route::get('/compare-remove/{id}' , 'CompareRemove');


});
 // Stripe All Route
 Route::controller(StripeController::class)->group(function(){
    Route::post('/stripe/order' , 'StripeOrder')->name('stripe.order');

    Route::post('/cash/order' , 'CashOrder')->name('cash.order');


});
// Frontend Blog Post All Route
Route::controller(BlogController::class)->group(function(){

    Route::get('/blog' , 'AllBlog')->name('home.blog');
    Route::get('/post/details/{id}/{slug}' , 'BlogDetails');
  Route::get('/post/category/{id}/{slug}' , 'BlogPostCategory');

   });
   // Frontend review All Route
Route::controller(ReviewController::class)->group(function(){

    Route::post('/store/review' , 'StoreReview')->name('store.review');

   });
 // User Dashboard All Route
 Route::controller(AllUserController::class)->group(function(){
    Route::get('/user/account/page' , 'UserAccount')->name('user.account.page');
    Route::get('/user/change/password' , 'UserChangePassword')->name('user.change.password');

    Route::get('/user/order/page' , 'UserOrderPage')->name('user.order.page');
    Route::get('/user/order_details/{order_id}' , 'UserOrderDetails');

    Route::get('/user/invoice_download/{order_id}' , 'UserOrderInvoice');
    Route::post('/return/order/{order_id}' , 'ReturnOrder')->name('return.order');
    Route::get('/return/order/page' , 'ReturnOrderPage')->name('return.order.page');


});


});


require __DIR__.'/auth.php';
