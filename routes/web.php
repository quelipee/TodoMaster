<?php

use App\Http\Controllers\ProfileController;
use App\TodoList\Controllers\TodoListController;
use App\TodoList\Models\TodoList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::get('/dashboard', function () {
    $todolist = TodoList::query()
        ->where('userId', Auth::id())
        ->paginate(5);
    return view('dashboard',compact('todolist'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::middleware('auth')->group(function () {
//    Route::resource('todolist', TodoListController::class);
//});

require __DIR__ . '/auth.php';
