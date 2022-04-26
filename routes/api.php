<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/post/store', 'PostController@store');

//Routing untuk menampilkan data
Route::get('/post', 'PostController@index');

//Routing untuk menampilkan data berdasarkan id
Route::get('/post/{id}', 'PostController@detail');

Route::post('/post/{id}', 'PostController@update');

Route::delete('/post/{id}', 'PostController@destroy');

