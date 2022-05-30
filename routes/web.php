<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/error', function () {
    throw new Exception("This is Error");
});



Route::get('/error2', function () {
    throw new Exception("This is Error 2");
});


Route::get('/error3', function () {
    throw new Exception("This is Error 3");
});

Route::get('/log', function () {
    Log::channel('cronJob')->info('Cron job logging info');
});


Route::get('/error4', function () {
    throw new \Illuminate\Auth\AuthenticationException();
});


Route::get('/error5', function () {
    throw new Exception("This is Error 5");
});