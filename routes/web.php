<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\DonationRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

 */

######################## Admin  Control Panel ###################################


Auth::routes();
Route::group(["middleware" => ["auth", "auto-check-permission"], "prefix" => "admin"], function () {

    //Admin Login Check
    // Route::get('/login/check', [LoginController::class, "showLoginForm"])->name('admin.login-check');

    // the home controller
    Route::get('/home', [Controller::class, "index"])->name('home.index');
    // The resource for governorate
    Route::resource('governorate', governorateController::class);
    // The resource for city
    Route::resource('city', cityController::class);
    // The resource for the Categories
    Route::resource('category', categoryController::class);
    // The resource for the posts
    Route::resource('post', postController::class);
    // The resource for the clients
    Route::resource('client', clientController::class);
    Route::post('/client/{client}/active', [clientController::class, "active"])->name('client.active');
    Route::post('/client/{client}/de-active', [clientController::class, "deActive"])->name('client.deActive');
    // Route contact
    Route::resource('contact', contactController::class);
    // Route donation request
    Route::resource('donation-request', donationRequestController::class);
    // Route Settings
    Route::get('/setting-edit', [settingController::class, "edit"])->name('setting.edit');
    Route::post('/setting-update', [settingController::class, "update"])->name('setting.update');
    // Route User Password
    Route::resource('user', userController::class);
    Route::get('/change-password/{id}', [userController::class, "change"])->name('password.edit-user');
    Route::put('/save-change/{id}', [userController::class, "saveChange"])->name('password.update-user');
    // Route Role
    Route::resource('role', roleController::class);
});
