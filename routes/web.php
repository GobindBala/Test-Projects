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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add-selected-items', [App\Http\Controllers\HomeController::class, 'itemSave'])->name('save_items');
Route::get('/add-items', [App\Http\Controllers\HomeController::class, 'itemAdd'])->name('add_items');
Route::get('/delete-items', [App\Http\Controllers\HomeController::class, 'itemDelete'])->name('delete_items');
