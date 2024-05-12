<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WarehousesController;
use App\Http\Controllers\Api\CitiesController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// php artisan route:cache (error)
// Route::apiresource('warehouses',WarehousesController::class);
// php artisan route:cache (solved) it has been used for api

Route::apiResource('cities',CitiesController::class,["as"=>"api"]);
Route::put('citiesstatus',[CitiesController::class,'typestatus']);

Route::apiResource('warehouses',WarehousesController::class,["as"=>"api"]);
Route::put('warehousesstatus',[WarehousesController::class,'typestatus']);

