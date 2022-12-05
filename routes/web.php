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

Route::get('/', 'App\Http\Controllers\UsuarioController@index');
Route::post('/store', 'App\Http\Controllers\UsuarioController@create');
Route::post('/edit/{id}', 'App\Http\Controllers\UsuarioController@edit');
Route::get('/destroy/{id}', 'App\Http\Controllers\UsuarioController@destroy');