<?php

use App\Http\Controllers\Cash\CashController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Sale\SaleController;
use App\Http\Controllers\Sale\Search;
use App\Http\Controllers\Stock\CategoryController;
use App\Http\Controllers\Stock\ProductController;
use App\Http\Controllers\Stock\UnitController;
use Illuminate\Support\Facades\Route;


//Login and Logout.
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store'])->name('login');
Route::get('/logout', [LoginController::class,'destroy'])->name('logout');
Route::middleware('auth')->group(function(){
    
    Route::get('/', [HomeController::class,'index'])->name("home");
    //Product
    Route::get('/product', [ProductController::class,'index'])->name('product');
    Route::get('/addproduct', [ProductController::class,'create'])->name('product.create');
    Route::post('/addproduct', [ProductController::class,'store'])->name('product.store');
    Route::post('/product/update', [ProductController::class,'update'])->name('product.update');
    Route::get('/product/edit', [ProductController::class,'edit'])->name('product.edit');
    Route::get('/product/search-code/{id}', [ProductController::class,'sCode'])->name('product.scode');
    // Unit of Product.
    Route::get('/unit', [UnitController::class,'index'])->name('unit');
    Route::post('/unit', [UnitController::class,'store'])->name('unit');
    Route::get('/unit/destroy/{id}', [UnitController::class,'destroy'])->name('unit.destroy');
    // Category of Product.
    Route::get('/category', [CategoryController::class,'index'])->name('category');
    Route::post('/category', [CategoryController::class,'store'])->name('category');
    Route::get('/category/destroy/{id}', [CategoryController::class,'destroy'])->name('category.destroy');
    //Client
    Route::resource('/client',ClientController::class);
    //Cash
    Route::resource('/cash',CashController::class)->only(['index','destroy','create','store','show']);
    //Sale
    Route::resource('/sale', SaleController::class);
    Route::post('sale/search',[Search::class,'search'])->name('sale.search');
    Route::get('/search/client',[Search::class,'client'])->name('search.client');
    //Company
    Route::resource('/company',CompanyController::class);

});