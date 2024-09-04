<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\UserProfileController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\TweetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post("register",[RegisterController::class,"register"]);
Route::post("login",[LoginController::class,"login"])->name("login");



Route::middleware(['auth:sanctum'])->group(function () {

    Route::get("/user-profile",[UserProfileController::class,"userProfile"]);
    Route::post("/tweets",[TweetController::class,"store"]);

    Route::post("/follow-user",[FollowController::class,"followUser"]);
    Route::get("/myfollowing-tweets",[FollowController::class,"getFollingUserTweet"]);
});

