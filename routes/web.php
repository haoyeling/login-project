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

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;


Route::get('user/register', [UserController::class, 'register']);
Route::post('user/create', [UserController::class, 'create']);
Route::get('user/login', [UserController::class, 'login']);
Route::post('user/login2', [UserController::class, 'login2']);
