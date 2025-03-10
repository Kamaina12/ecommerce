<?php
use App\Http\Controllers\ControllersUserController;
use App\Http\Controllers\Auth\ControllersForgotPasswordPage;
use App\Http\Controllers\Auth\ControllersLoginPage;
use App\Http\Controllers\Auth\ControllersRegisterPage;
use App\Http\Controllers\Auth\ControllersResetPasswordPage;
use App\Http\Controllers\ControllersCancelPage;
use App\Http\Controllers\ControllersCartPage;
use App\Http\Controllers\ControllersCategoriesPage;
use App\Http\Controllers\ControllersCheckoutPage;
use App\Http\Controllers\ControllersHomePage; 
use App\Http\Controllers\ControllersMyOrderDetailPage;
use App\Http\Controllers\ControllersMyOrdersPage;
use App\Http\Controllers\ControllersProductDetailPage;
use App\Http\Controllers\ControllersProductPage;
use App\Http\Controllers\ControllersSuccessPage;
use Illuminate\Support\Facades\Route;

Route::get('/', ControllersHomePage::class);

 // Use array notation

Route::get('/categories',ControllersCategoriesPage::class);
Route::get('/products',ControllersProductPage::class);
Route::get('/cart',ControllersCartPage::class);
Route::get('/checkout',ControllersCheckoutPage::class);
Route::get('/my-orders',ControllersMyOrdersPage::class);
Route::get('/products/{slug}',ControllersProductDetailPage::class);
Route::get('/my-orders/{order}',ControllersMyOrderDetailPage::class);
Route::get('/theme1',[ControllersUserController::class,'theme']);
// Route::get('/theme1',[UserController::class,'theme']);


//login
// Route::get('/login',ControllersLoginPage::class);
// Route::get('/register',ControllersRegisterPage::class);
// Route::get('/forgot',ControllersForgotPasswordPage::class);
// Route::get('/reset',ControllersResetPasswordPage::class);
// Route::get('/success',ControllersSuccessPage::class);
// Route::get('/cancel',ControllersCancelPage::class);
