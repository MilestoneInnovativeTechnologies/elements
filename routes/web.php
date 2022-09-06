<?php

use Illuminate\Support\Facades\Route;
use Milestone\Elements\Controllers\CustomersController;
use Milestone\Elements\Controllers\ItemController;
use Milestone\Elements\Controllers\OrderController;
use Milestone\Elements\Controllers\UserController;

//Route::get('/', function () {
//    return 'Elements Setup Okey';
//});


Route::get('/', function () {
    return view('Elements::se_dashboard');
});
Route::get('itemlist', [ItemController::class, 'itemlist'])->name('itemlist');
Route::get('customerlist', [CustomersController::class, 'customerlist'])->name('customerlist');
Route::get('customerdetails', [CustomersController::class, 'customerdetails'])->name('customerdetails');
Route::get('ordersummary', [OrderController::class, 'ordersummary'])->name('ordersummary');
Route::get('profile', [UserController::class, 'profile'])->name('profile');
