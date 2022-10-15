<?php

use Illuminate\Support\Facades\Route;
use Milestone\Elements\Controllers\AdminController;
use Milestone\Elements\Controllers\SalesexecutiveController;
use Milestone\Elements\Controllers\CustomersController;
use Milestone\Elements\Controllers\ItemController;
use Milestone\Elements\Controllers\CartController;
use Milestone\Elements\Controllers\OrderController;
use Milestone\Elements\Controllers\UserController;

use \Milestone\Elements\Controllers\LoginController;

Route::get('/', function () {
    return redirect('index');
});

Route::group([
    'middleware' => 'auth'
],function(){
    Route::get('index', [SalesexecutiveController::class, 'index'])->name('index');
    Route::get('orderhistory', [SalesexecutiveController::class, 'orderhistory'])->name('orderhistory');
    Route::get('deleteorder/{id}', [SalesexecutiveController::class, 'deleteorder'])->name('deleteorder');

    Route::get('adminindex', [AdminController::class, 'index'])->name('adminindex');
    Route::get('customerlist', [CustomersController::class, 'customerlist'])->name('customerlist');
    Route::get('itemlist', [ItemController::class, 'itemlist'])->name('itemlist');
    Route::get('searchcustomer', [CustomersController::class, 'searchcustomer'])->name('searchcustomer');
    Route::get('selectcustomer', [CustomersController::class, 'selectcustomer'])->name('selectcustomer');
    Route::get('searchitems', [ItemController::class, 'searchitems'])->name('searchitems');
    Route::get('addtocart', [CartController::class, 'addtocart'])->name('addtocart');

    Route::get('customerdetails', [CustomersController::class, 'customerdetails'])->name('customerdetails');
    Route::get('ordersummary', [OrderController::class, 'ordersummary'])->name('ordersummary');

    Route::post('saveorder', [OrderController::class, 'saveorder'])->name('saveorder');
    Route::post('saveitem', [OrderController::class, 'saveitem'])->name('saveitem');
    Route::get('orderdisplay/{id}', [OrderController::class, 'orderdisplay'])->name('orderdisplay');

    Route::post('deleteitem', [CartController::class, 'deleteitem'])->name('deleteitem');
    Route::post('updateitem', [CartController::class, 'updateitem'])->name('updateitem');
    Route::post('invoicediscount', [CartController::class, 'invoicediscount'])->name('invoicediscount');
    Route::post('foc', [CartController::class, 'foc'])->name('foc');
    Route::post('referencenumber', [CartController::class, 'referencenumber'])->name('referencenumber');
    Route::post('creditperiod', [CartController::class, 'creditperiod'])->name('creditperiod');
    Route::get('clearcart', [CartController::class, 'clearcart'])->name('clearcart');

    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('updateprofile', [UserController::class, 'updateprofile'])->name('user.updateprofile');
    Route::resource('user', UserController::class);

    Route::get('admin_editorder/{id}', [AdminController::class, 'admin_editorder'])->name('admin_editorder');


});

Route::view('login','Elements::login')->name('login');
Route::get('logout',[LoginController::class,'logout'])->name('logout');
Route::post('login',[LoginController::class,'login']);
