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
    return view('home');
});

Route::get('/users/add', "UsersController@add");
Route::post('/users/add/post', "UsersController@post");
Route::post('/users/update/{id}', "UsersController@update");
Route::get('/users/delete/{id}', "UsersController@delete");
Route::get('/users/edit/{id}', "UsersController@edit");
Route::get('/users/view/{id}', "UsersController@view");
Route::get('/users/list', "UsersController@list");
