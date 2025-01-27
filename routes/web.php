<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Stock\ProductController;
use App\Http\Controllers\Stock\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store'])->name('login');
Route::get('/logout', [LoginController::class,'destroy'])->name('logout');
Route::get('/', function () {
    return view('home',["title"=> "Home"]);
})->name("home");
Route::get('/product', [ProductController::class,'index'])->name('product');
Route::get('/unit', [UnitController::class,'index'])->name('unit');
