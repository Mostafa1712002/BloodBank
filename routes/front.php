
<?php


use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\Front\donationRequest;
use App\Http\Controllers\Auth\ClientResetPasswordController;
use App\Http\Controllers\Auth\ClientForgotPasswordController;

Auth::routes();
########################  Front Routes       ###########################################
Route::get('/', [MainController::class, "index"])->name('front.index');

Route::group(["prefix" => "front"], function () {

    #######################  Route if the client if note auth       ##################################
    Route::get('/contact-us', [MainController::class, "contactUs"])->name('contact-us');
    Route::get('/inside-request', [MainController::class, "insideRequest"])->name('inside-request');
    Route::get('/who-are-us', [MainController::class, "whoAreUs"])->name('who-are-us');
    Route::get('/about-blood-bank', [MainController::class, "aboutBloodBank"])->name('about-blood-bank');
    Route::get('/inside-post/{id?}', [MainController::class, "insidePost"])->name('client-inside-post');
    Route::get('/article-details', [MainController::class, "articleDetails"])->name('article-details');
    Route::resource('client-donation-request', DonationRequest::class);


    // Login and Register
    Route::get('/sign-in-account', [AuthController::class, "signInAccount"])->name('sign-in-account');
    Route::get('/sign-in-check', [AuthController::class, "signInCheck"])->name('sign-in-check');
    Route::get('/register-save', [AuthController::class, "registerSave"])->name('client.register-save');
    Route::get('/create-account', [AuthController::class, "createAccount"])->name('create-account');
    Route::get('/governorate', [AuthController::class, "governorate"])->name("auth.governorate");





    ############################### Routes if the client register and sign in ######################
    Route::middleware('auth:front')->group(function () {
        // Log out

        Route::post('/client/logout', [AuthController::class, "logout"])->name('client-logout');
        Route::post("/toggle-favorite", [MainController::class, "postFavorite"])->name("client-toggle-favorite");
        // Resource for the auth  --> Profile
        Route::resource('/profile', MainController::class);
    });


});
