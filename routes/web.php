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
Auth::routes(['register'=>false]);
Route::get('/', function () {

   return redirect()->route('dashboard.index');
});
Route::get('/admin', function () {
    return view('admin');
});

Route::get('/a', function () {
    return view('admin2');
});

Route::get('/test', function () {
    return view('test');
});


Route::get('/home', 'HomeController@index')->name('home');
