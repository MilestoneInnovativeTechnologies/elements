<?php

use Illuminate\Support\Facades\Route;
use Milestone\Elements\Controllers\CustomersController;
use Milestone\Elements\Controllers\ItemController;
use Milestone\Elements\Controllers\CartController;
use Milestone\Elements\Controllers\OrderController;
use Milestone\Elements\Controllers\UserController;

//Route::get('/', function () {
//    return 'Elements Setup Okey';
//});


Route::get('/', function () {
    return view('Elements::se_dashboard');
});
Route::get('customerlist', [CustomersController::class, 'customerlist'])->name('customerlist');
Route::get('itemlist', [ItemController::class, 'itemlist'])->name('itemlist');
Route::get('selectcustomer', [CartController::class, 'selectcustomer'])->name('selectcustomer');
Route::get('addtocart', [CartController::class, 'addtocart'])->name('addtocart');

Route::get('customerdetails', [CustomersController::class, 'customerdetails'])->name('customerdetails');
Route::get('ordersummary', [OrderController::class, 'ordersummary'])->name('ordersummary');
Route::post('ordersummary', [OrderController::class, 'store']);

Route::get('profile', [UserController::class, 'profile'])->name('profile');
//Route::get('profile', [UserController::class, 'store']);
