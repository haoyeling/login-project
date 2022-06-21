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


use App\Http\Controllers\Login;
Route::get('/login',[Login::class,'index']);
Route::post('/doLogin',[Login::class,'doLogin']);

use App\Http\Controllers\Register;
Route::get('/register',[Register::class,'index']);
Route::post('/doRegister',[Register::class,'doRegister']);