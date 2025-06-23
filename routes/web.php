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
    return view('auth.login');
});

Auth::routes();

Route::get('/inbox', [App\Http\Controllers\HomeController::class, 'inbox'])->name('email-inbox');
Route::get('/sent', [App\Http\Controllers\HomeController::class, 'sent'])->name('email-sent');
Route::get('/compose', [App\Http\Controllers\HomeController::class, 'compose'])->name('email-compose');
Route::get('/read/{id}', [App\Http\Controllers\HomeController::class, 'read'])->name('email-read');
Route::post('/compose', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
Route::get('/read/{id}/download', [App\Http\Controllers\HomeController::class, 'get_file'])->name('get_file');
