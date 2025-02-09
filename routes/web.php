<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserContriller;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'home');
Route::view('/contact', 'contact');

Route::resource('jobs', JobController::class);

//auth
Route::get('/register', [RegisteredUserContriller::class, 'create']);
Route::post('/register', [RegisteredUserContriller::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);