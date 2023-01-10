<?php

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
    $pass = 0;
    return view('welcome')->with('pass', $pass);
});
Route::get('/generate', 'App\Http\Controllers\Controller@generatePass')->name('generate');
Route::get('/savetofile/{id}', 'App\Http\Controllers\Controller@savetofile')->name('savetofile');
