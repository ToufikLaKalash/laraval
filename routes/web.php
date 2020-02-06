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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@log')->name('admin');
Route::post('/admin', 'AdminController@post')->name('admin');
Route::delete('/admin/delete', 'AdminController@delete')->name('admin/delete');
Route::post('/admin/modify', 'AdminController@modify')->name('admin/modify');
Route::post('/admin/add', 'AdminController@add')->name('admin/add');
