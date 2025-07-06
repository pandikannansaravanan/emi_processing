<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;

Route::namespace('App\\Http\\Controllers')->group(function () {
    Route::match(['get', 'post'], '/login', 'UserController@index')->name('login')->middleware('guest');
    Route::match(['get', 'post'],'/logout', 'UserController@logout')->name('logout')->middleware('auth');
    Route::get('/', 'LoanController@index')->middleware('auth')->name('loans');
    Route::get('/emi', 'LoanController@emi')->middleware('auth')->name('emi');
    Route::post('/process-emi', 'LoanController@processEmi')->middleware('auth');
});