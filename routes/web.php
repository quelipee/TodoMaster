<?php

use App\TodoList\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('todolist', TodoListController::class);
