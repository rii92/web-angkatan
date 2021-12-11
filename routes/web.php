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
    return view('homepage');
});

Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->prefix('dashboard')->group(function(){
    Route::get('', function () {
        return view('dashboard.home');
    })->name('dashboard');

    Route::get('users', function () {
        return view('dashboard.users');
    })->name('dashboard.users');
});
