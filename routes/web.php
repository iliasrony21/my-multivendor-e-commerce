<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Vendor\VendorController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('frontend.index');
});


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
          Route::controller(ProductController::class)->group(function(){

            Route::get("add/product",'addProduct')->name('add.product');
            Route::get("all/product",'allProduct')->name('all.product');
            Route::post("store/product",'StoreProduct')->name('store.product');


        });
});

Route::get('admin/login',[AdminController::class,'login'])->name('admin.login');



///////All Routes for vendor ///////////////
Route::middleware('auth', 'role:vendor')->group(function () {
    Route::get('vendor/dashboard', [VendorController::class, 'index'])->name('vendor.dashboard');
    Route::post('vendor/logout', [VendorController::class, 'logout'])->name('vendor.logout');
    Route::get('vendor/profile', [VendorController::class, 'profile'])->name('vendor.profile');
    Route::get('vendor/change/password', [VendorController::class, 'changePassword'])->name('vendor.changePassword');
    Route::post('vendor/update/password', [VendorController::class, 'updatePassword'])->name('vendor.update.password');
    Route::post('vendor/update/profile', [VendorController::class, 'updateProfile'])->name('vendor.update.profile');
});
Route::get('vendor/login',[VendorController::class,'login'])->name('vendor.login');
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


require __DIR__.'/auth.php';
