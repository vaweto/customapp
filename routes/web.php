<?php

use App\Task;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tasks', 'TaskController@index');
Route::get('/tasks/{task}', 'TaskController@show');

