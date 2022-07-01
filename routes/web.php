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
use App\Http\Controllers\UserCarnivalController;

Route::get('user/register', [UserController::class, 'register']);
Route::post('user/create', [UserController::class, 'create']);
Route::get('user/login', [UserController::class, 'login']);
Route::post('user/login2', [UserController::class, 'login2']);
Route::get('sign', [UserCarnivalController::class, 'signIn']);
Route::post('user-carnival/update', [UserCarnivalController::class, 'update']);

//路由保护
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('user/logout', [UserController::class, 'logout']);
    Route::get('user-carnival/add', [UserCarnivalController::class, 'add']);
    Route::get('user-carnival/delete', [UserCarnivalController::class, 'delete']);
    Route::post('user-carnival/create', [UserCarnivalController::class, 'create']);
});