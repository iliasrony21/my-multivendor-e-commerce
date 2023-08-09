<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
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
});

Route::get('admin/login',[AdminController::class,'login'])->name('admin.login')->middleware(MiddlewareRedirectIfAuthenticated::class);



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



require __DIR__.'/auth.php';
