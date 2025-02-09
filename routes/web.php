<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TenantController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['check_domain']], function () {
    Route::post('auth/login', [AuthController::class, 'authenticate']);
    Route::get('/', [AuthController::class, 'login'])->name('central.login');
});


Route::get('/mail',[MailController::class,'mailSend'])->middleware('token.auth');

// Route::group(['middleware' => ['logged_in']], function () {

//     // Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
//     // Route::get('logout', [AuthController::class, 'logout'])->name('logout');
//     // Route::get('user', [UserController::class, 'index'])->name('user');
//     // Route::resource('roles', RoleController::class)
//     // ->only(['create']);

//     // Route::get('/category',[CategoryController::class,'index']);
//     // Route::get('/category/create',[CategoryController::class,'create']);
//     // Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');

// });

Route::group(['middleware' => ['logged_in','auth']], function () {

    Route::view('/admin/dashboard', 'admin.dashboard')->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('user', [UserController::class, 'index'])->name('user');

    
    Route::resource('roles', RoleController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('tenant', TenantController::class);
    Route::resource('product', ProductController::class);
    
}) ;
Route::get('/test',[CategoryController::class,'test'])->name('category.test');

Route::get('get-product/{category?}/{brand?}',[ProductController::class,'product']);


Route::fallback(function () {
    abort(403, 'Page Not Found');

});






