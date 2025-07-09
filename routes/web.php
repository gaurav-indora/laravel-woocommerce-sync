<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login-form');

Route::post('adminloginpost', [App\Http\Controllers\Auth\LoginController::class, 'adminloginpost'])->name('admin.login.post');

Route::group(['middleware' => 'auth'], function() {

    Route::get('admin_dashboard',[App\Http\Controllers\admin\dashboardcontroller::class, 'admin_dashboard'])->name('admin_dashboard');

    Route::match(['get', 'post'], '/addproduct', [App\Http\Controllers\admin\productcontroller::class, 'addproduct'])->name('add.product');

    Route::get('/viewproduct',[App\Http\Controllers\admin\productcontroller::class, 'viewproduct'])->name('view.product');

    Route::get('/adminlogout',[App\Http\Controllers\Auth\LoginController::class, 'adminlogout'])->name('adminlogout');

    Route::get('fetchcity/{id}',[App\Http\Controllers\admin\productcontroller::class, 'fetchcity'])->name('fetchcity');

    Route::post('/ajax-validate',[App\Http\Controllers\admin\productcontroller::class, 'ajax_validate'])->name('ajax.validate');

    Route::get('productdetail/{id}',[App\Http\Controllers\admin\productcontroller::class, 'productdetail'])->name('productdetail');

    Route::get('sync/product',[App\Http\Controllers\admin\productcontroller::class, 'sync_product'])->name('sync.product');

    Route::get('/opencontact/{id}',[App\Http\Controllers\admin\productcontroller::class, 'opencontact'])->name('opencontact');

    Route::match(['get', 'post'], '/editproduct/{id}', [App\Http\Controllers\admin\productcontroller::class, 'editproduct'])->name('edit.product');

    Route::get('/delete/product/{id}',[App\Http\Controllers\admin\productcontroller::class, 'delete_product'])->name('delete.product');

    Route::get('/product/chngestatus/{id}',[App\Http\Controllers\admin\productcontroller::class, 'product_chngestatus'])->name('product.chngestatus');

    


});