<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Fruitcake\Cors\HandleCors; // Importa el middleware de CORS
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

Route::middleware(HandleCors::class)->group(function () {

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::controller(UserControlle::class)->group(function(){

        Route::post("/login", "login");
        Route::post("/signup", "signup");
        Route::post("/edit", "edit");
        Route::post("/forgot", "forgot");
        Route::post("/changePassword", "changePassword");

    });

    Route::controller(ProductController::class)->group(function(){

        Route::get("/products/get", "getAll");
        Route::post("/search/{text}", "search");

    });

    Route::controller(OrderController::class)->group(function(){

        Route::post("/setOrder", "login");
        Route::get("/history/get", "history");

    });

    Route::controller(OrderController::class)->group(function(){

        Route::get("/categories/get", "getAll");

    });
});