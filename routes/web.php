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
Route::get('searchcustomer', [CustomersController::class, 'searchcustomer'])->name('searchcustomer');
Route::get('selectcustomer', [CustomersController::class, 'selectcustomer'])->name('selectcustomer');
Route::get('searchitems', [ItemController::class, 'searchitems'])->name('searchitems');
Route::get('addtocart', [CartController::class, 'addtocart'])->name('addtocart');

Route::get('customerdetails', [CustomersController::class, 'customerdetails'])->name('customerdetails');
Route::get('ordersummary', [OrderController::class, 'ordersummary'])->name('ordersummary');
Route::get('saveorder', [CartController::class, 'saveorder'])->name('saveorder');
Route::post('ordersummary', [OrderController::class, 'store']);
Route::post('deleteitem', [CartController::class, 'deleteitem'])->name('deleteitem');
Route::post('updatecart', [CartController::class, 'updateCart'])->name('updateCart');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

Route::get('profile', [UserController::class, 'profile'])->name('profile');
//Route::get('profile', [UserController::class, 'store']);
