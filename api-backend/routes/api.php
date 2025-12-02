<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControler;
use App\Http\Controllers\ProductController;

Route::post("register" ,[AuthControler::class, "register"]);
Route::post("login" ,[AuthControler::class, "login"]);

Route::group([
    "middleware" => ["auth:sanctum"]
], function(){

    Route::get("profile" ,[AuthControler::class, "profile"]);
    Route::get("logout" ,[AuthControler::class, "logout"]);

    Route::apiResource('products', ProductController::class);
});

//Route::get('/user', function (Request $request) {
//  return $request->user();
//})->middleware('auth:sanctum');
