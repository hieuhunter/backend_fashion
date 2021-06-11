<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ql_thoitrangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('product', [ql_thoitrangController::class, 'product']);
Route::get('category', [ql_thoitrangController::class, 'danhmuc']);
Route::get('brand', [ql_thoitrangController::class, 'thuonghieu']);
Route::get('brand/{id}', [ql_thoitrangController::class, 'sptheoth']);
Route::get('category/{id}', [ql_thoitrangController::class, 'sptheodm']);
Route::get('product/{id}', [ql_thoitrangController::class, 'ctProduct']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::delete('delete_cart', [ql_thoitrangController::class, 'xoacart']);
    Route::delete('delete_all', [ql_thoitrangController::class, 'xoatatcagh']);
    Route::get('listCart', [ql_thoitrangController::class, 'danhsachcart']);
    Route::get('personal', [ql_thoitrangController::class, 'thongtin']);
    Route::get('addCart', [ql_thoitrangController::class, 'addgiohang']);
    Route::get('user', [AuthController::class, 'user']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('pay', [ql_thoitrangController::class, 'thanhtoan']);
});
