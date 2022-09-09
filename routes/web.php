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
    return view('welcome');
});

Route::get('articles/{article}','App\Http\Controllers\Api\ArticleController@show');

Route::get('saludo/{nombre?}', function ($nombre="invitado") {
    //return view('welcome');
    return "Saludos ".$nombre;
});
