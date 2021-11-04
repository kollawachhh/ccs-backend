<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RequestController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//admin
Route::get('/admin/all-users', [AdminController::class, 'all_users']);
Route::get('/admin/create_user', [AdminController::class, 'create_user']);
Route::get('/admin/user/{id}', [AdminController::class, 'get_user']);

//employee
Route::get('/employee/all-customers', [CustomerController::class, 'all_customers']);
Route::get('/employee/all-waiting-request', [RequestController::class, 'all_waiting_request']);
Route::post('/employee/update-status/{id}', [RequestController::class, 'update_status']);
Route::post('/employee/appointment/{id}', [RequestController::class, 'appointment']);
Route::get('/employee/user/{id}', [UserController::class, 'get_user_by_id']);

//customer
Route::post('/customer/create_customer', [UserController::class, 'create_customer']);
Route::post('/customer/create_request', [RequestController::class, 'create_request']);
Route::get('/customer/all_requests/{id}', [RequestController::class, 'all_requests_by_id']);
Route::get('/customer/request/{id}', [RequestController::class, 'request_detail_by_id']);
Route::get('/customer/request/appoint-date', [RequestController::class, 'all_appointed']);

// JWT-Auth
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
});