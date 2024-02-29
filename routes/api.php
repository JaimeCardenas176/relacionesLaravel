<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;



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

Route::controller(UserController::class)->group(function () {
    Route::post("/login", "login");
    Route::post("/signup", "signup");
    Route::middleware('auth:sanctum')->group(function () {
        Route::post("/edit", "edit");
        Route::post("/forgot", "forgot");
        Route::post("/changePassword", "changePassword");
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(OrderController::class)->group( function() {
        Route::post("/setOrder", "login");
        Route::get("/history/get", "history");
    });
});

Route::controller(CategoryController::class, function ($router) {
    Route::get("/categories/get", "getAll");
});

Route::controller(ProductController::class)->group(function () {
    Route::get("/products/get", "getAll");
    Route::post("/search/{text}", "search");
});