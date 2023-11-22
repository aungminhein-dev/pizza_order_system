<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Feedbacks;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\UserManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//login / register
// Route::get('auth/facebook/redirect',[SocialAuthController::class,'facebookRedirect'])->name('facebookLogin');
// Route::get('auth/facebook/callback',[SocialAuthController::class,'facebookLogin'])->name('callingback');

Route::get('auth/google/redirect',[SocialAuthController::class,'redirect'])->name('googleLogin');
Route::get('auth/google/callback',[SocialAuthController::class,'callBackGoogle'])->name('callingback');

Route::get('/auth/facebook/redirect',[SocialAuthController::class,'redirectFacebook'])->name('facebookRedirect');
Route::get('/auth/facebook/callback',[SocialAuthController::class,'callBackFacebook'])->name('facebookCallback');

Route::middleware(['admin_auth'])->group(function () {
    Route::get('/',[AuthController::class,'homePage'])->name('auth#origin');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class, 'registerPage'])->name('auth#registerPage');

});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    Route::get('noti',[AuthController::class,'notipage'])->name('noti#mywork');


    //admin Page
    //category section
    Route::middleware(['admin_auth'])->group(function () {
            //dashboard

        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class, 'list'])->name('category#list');
            Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');//create items
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');//delete items
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');//editing items
            Route::post('update',[CategoryController::class,'update'])->name('category#update');

        });
        Route::prefix('order')->group(function(){
            Route::get('orderList',[OrderController::class,'order'])->name('order#orderList');
            Route::get('status/sort',[OrderController::class,'statusSort'])->name('order#statusSort');
            Route::get('status/update',[OrderController::class,'updateStatus'])->name('order#updateStatus');
            Route::post('accept',[OrderController::class,'accept'])->name('order#accept');
            Route::post('deny/{id}',[OrderController::class,'deny'])->name('order#deny');
            Route::get('pendings',[OrderController::class,'pending'])->name('order#pendings');
            Route::get('orderDetail/{id}',[OrderController::class,'orderDetail'])->name('order#details');
        });
        Route::prefix('admin_account')->group(function () {
            Route::get('account/settings',[AdminController::class,'settings'])->name('admin#accountSettings');
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])
            ->name('admin#changePasswordPage');//change password page
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');//change;
            Route::get('account/details',[AdminController::class,'accountDetails'])->name('admin#accountDetails');//account details;
            Route::get('account/edit',[AdminController::class,'editAccount'])->name('admin#editAccount');//edit account
            Route::post('accountupdate/{id}',[AdminController::class,'update'])->name('admin#update');
            //admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}', [AdminController::class,'delete'])->name('admin#deleteAccount');
            Route::get('editrole/{id}',[AdminController::class,'editRole'])->name('admin#editRole');
            Route::post('changeRole/{id}',[AdminController::class,'change'])->name('admin#roleChange');
            Route::get('changeRole',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::get('fun',[DashboardController::class, 'funPage'])->name('admin#dashboard');
            Route::get('take',[DashboardController::class,'take'])->name('take');
        });

        //products
        Route::prefix('products')->group(function(){
            Route::get('lists',[ProductController::class,'list'])->name('product#list');
            Route::get('create',[ProductController::class,'createPage'])->name('product#create');
            Route::post('create',[ProductController::class,'create'])->name('product#creates');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('details/{id}',[ProductController::class,'details'])->name('product#details');
            Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            Route::post('update',[ProductController::class,'update'])->name('product#update');
        });
        Route::prefix('userManage')->group(function(){
            Route::get('accounts',[UserManagementController::class,'account'])->name('userManage#accountsManagement');
            Route::get('change/user',[UserManagementController::class,'changeRole'])->name('userManage#changeUser');
        });


    });



        // Route::get('password/change',function(){
        //     return view('admin.password.change');
        // });

    //user Page
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
        Route::get('home',[UserController::class,'home'])->name('user#home');
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('history',[UserController::class,'history'])->name('user#history');
        Route::get('orderDetails/{id}',[AjaxController::class,'orderDetail'])->name('user#orderDetails');
        Route::get('addView',[UserController::class,'viewCount'])->name('user#addview');
        Route::get('send-email/{userId}',[UserController::class,'sendMail'])->name('user#sendmail');
        Route::get('orderinvoice/{id}',[UserController::class,'invoice'])->name('user#invoice');

        Route::prefix('products')->group(function(){
            Route::get('details/{id}',[UserController::class,'details'])->name('userproducts#details');

            Route::get('writePage/{id}',[UserController::class,'write'])->name('user#write');

        });

        Route::prefix('security')->group(function(){
            Route::get('changePw',[UserController::class,'pwChange'])->name('user#changePw');
            Route::post('changePw',[UserController::class,'changePassword'])->name('user#changePassword');
            Route::get('info',[UserController::class,'info'])->name('user#info');
            Route::post('update/{id}',[UserController::class,'update'])->name('user#update');
        });

        Route::prefix('ajax')->group(function(){
            Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzalist');
            Route::get('cart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clearCart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            Route::get('remove/eachItem',[AjaxController::class,'removeItem'])->name('ajax#removeItem');
            Route::get('viewCount',[AjaxController::class,'viewC'])->name('ajax#views');

        });

        Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
        });
    });

    Route::post('comments',[UserController::class,'feedbacks'])->name('user#feedbacks');
 });



