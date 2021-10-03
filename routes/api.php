<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

########### The api get routes         ###########

Route::group(["prefix" => "v1", "namespace" => "Api"], function () {
    Route::get('/posts', [MainController::class, "posts"]);
    Route::get('/governorates', [MainController::class, "governorates"]);
    Route::get('/cities', [MainController::class, "cities"]);
    Route::get('/categories', [MainController::class, "categories"]);
    Route::get('/bloodTypes', [MainController::class, "bloodTypes"]);
    Route::get('/donation-requests', [MainController::class, "donationRequests"]);

    // login && register
    Route::post('/login', [AuthController::class, "login"]);
    Route::post('/register', [AuthController::class, "register"]);
    Route::post('/new-password', [AuthController::class, "newPassword"])->name("newPassword");
    Route::post('/reset-password', [AuthController::class, "resetPassword"]);

    Route::post('/create-contact', [MainController::class, "createContact"]);

    
    // Auth routes
    Route::middleware("auth:client-api")->group(function () {

        Route::post('/register-token', [AuthController::class, "registerToken"]);
        Route::post('/remove-token', [AuthController::class, "removeToken"]);
        // which is get && auth
        Route::get('/all-settings', [MainController::class, "allSettings"]);
        Route::get('/list_favorite', [MainController::class, "myFavorite"]);
        Route::get('/notifications', [MainController::class, "notifications"]);

        Route::post('/city', [MainController::class, "city"]);
        Route::post('/catagories', [MainController::class, "categories"]);
        Route::post('/create-donation-request', [MainController::class, "createDonationRequest"]);
        Route::post('/post-favorite', [MainController::class, "postFavorite"]);
        Route::post('/update-profile', [MainController::class, "updateProfile"]);
        Route::post('/notification-settings', [MainController::class, "NotificationSettings"]);
    });
});
