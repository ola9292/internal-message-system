<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\MessagesController::class, 'index'])->name('home');
Route::get('/create/{id?}/{subject?}', [App\Http\Controllers\MessagesController::class, 'create'])->name('create');
Route::post('/store', [App\Http\Controllers\MessagesController::class, 'store'])->name('store');
Route::get('/sent-messages', [App\Http\Controllers\MessagesController::class, 'sentMessages'])->name('sent.messages');
Route::get('/read/{id}', [App\Http\Controllers\MessagesController::class, 'ReadMessages'])->name('read.messages');
Route::get('/delete/{id}', [App\Http\Controllers\MessagesController::class, 'delete'])->name('delete');
Route::get('/deleted', [App\Http\Controllers\MessagesController::class, 'deleted'])->name('deleted-messages');
Route::get('/return/{id}', [App\Http\Controllers\MessagesController::class, 'return'])->name('return');

