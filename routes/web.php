<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontEndController;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;

Route::group(['middleware' => ['check_domain']], function () {
    Route::post('auth/login', [AuthController::class, 'authenticate']);
    Route::get('/login', [AuthController::class, 'login'])->name('central.login');
});

Route::get('/', [FrontEndController::class, 'index'])->name('home');


Route::get('/mail',[MailController::class,'mailSend'])->middleware('token.auth');



Route::group(['middleware' => ['logged_in','auth']], function () {

    Route::view('/admin/dashboard', 'admin.dashboard')->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('user', [UserController::class, 'index'])->name('user');

    
    Route::resource('role', RoleController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('tenant', TenantController::class);
    Route::resource('product', ProductController::class);
    Route::resource('tag', TagController::class);
    Route::resource('user', UserController::class);



    Route::get('assign_role_permission',[AccessController::class,'assign_role_permission'])->name('setting.assign_role_permission');
    Route::post('assign_role_module',[AccessController::class,'assign_role_module_store'])->name('setting.store_role_permission');

    Route::get('assign_special_permission',[AccessController::class,'assign_special_permission'])->name('setting.assign_special_permission');
    Route::post('store_special_permission',[AccessController::class,'store_special_permission'])->name('setting.store_special_permission');

    Route::get('permission/role/{id}',[AccessController::class,'role'])->name('setting.check_role_permission');
    Route::get('permission/user/{id}',[AccessController::class,'user'])->name('setting.check_user_permisson');


    
}) ;
Route::get('/test',[CategoryController::class,'test'])->name('category.test');

Route::get('get-product/{category?}/{brand?}',[ProductController::class,'product']);


Route::fallback(function () {
    abort(403, 'Page Not Found');

});






