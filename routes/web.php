<?php

use Illuminate\Support\Facades\Route;
use Milestone\Controllers\ItemController;

//Route::get('/', function () {
//    return 'Elements Setup Okey';
//});


Route::get('/', function () {
    return view('Elements::se_dashboard');
});
Route::get('itemlist', [ItemController::class, 'Elements::itemlist'])->name('itemlist');
