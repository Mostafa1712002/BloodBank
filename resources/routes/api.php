<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\MainController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["prefix" => "v1", "namespace" => "api"], function () {
    Route::get('/post', [MainController::class, "post"])->middleware("auth:api");
    Route::get('/posts', [MainController::class, "posts"]);
    Route::get('/governorates', [MainController::class, "governorates"]);
    Route::get('/cities', [MainController::class, "cities"]);
    Route::get('/categories', [MainController::class, "categories"]);
    Route::get('/bloodTypes', [MainController::class, "bloodTypes"]);
    Route::get('/donation-requests', [MainController::class, "donationRequests"]);
    // which is get && auth
    Route::middleware('auth:api')->group(function () {
        Route::get('/all-settings', [MainController::class, "allSettings"]);
        Route::get('/list_favorite', [MainController::class, "myFavorite"]);
        Route::get('/notifications', [MainController::class, "notifications"]);

        //end.............


        ################# The api Post routes ########################

        Route::post('/register', [AuthController::class, "register"]);
        Route::post('/login', [AuthController::class, "login"]);
        Route::post('/password', [AuthController::class, "password"]);
        // Auth routes
        Route::middleware("auth:api")->group(function () {
            Route::post('/new-password', [AuthController::class, "newPassword"])->name("newPassword");
            Route::post('/reset-password', [AuthController::class, "resetPassword"]);
            Route::post('/register-token', [AuthController::class, "registerToken"]);
            Route::post('/remove-token', [AuthController::class, "removeToken"]);

            Route::post('/city', [MainController::class, "city"]);
            Route::post('/catagories', [MainController::class, "category"]);
            Route::post('/create-donation-request', [MainController::class, "createDonationRequest"]);
            Route::post('/post-favorite', [MainController::class, "postFavorite"]);
            Route::post('/create-contact', [MainController::class, "createContact"]);
            Route::post('/update-profile', [MainController::class, "updateProfile"]);
            Route::post('/notification-settings', [MainController::class, "NotificationSettings"]);

        });
    });
});
