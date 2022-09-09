<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('articles/{article}','App\Http\Controllers\Api\ArticleController@show')->name('api.v1.articles.show');

Route::get('articles','App\Http\Controllers\Api\ArticleController@index')->name('api.v1.articles.index');
