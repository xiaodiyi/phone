<?php

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
Route::get('phone/login','Auth\LoginController@login');
Route::post('phone/loginfrom','Auth\LoginController@LoginData')->name('phone.login');
Route::post('phone/code','Auth\LoginController@sendLoginPhoneCode');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

