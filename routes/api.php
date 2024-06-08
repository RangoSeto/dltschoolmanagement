<?php

use App\Http\Controllers\Api\CategoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CitiesController;
use App\Http\Controllers\Api\DaysController;
use App\Http\Controllers\Api\GendersController;
use App\Http\Controllers\Api\PaymenttypesController;
use App\Http\Controllers\Api\StagesController;
use App\Http\Controllers\Api\StatusesController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\TypesController;
use App\Http\Controllers\Api\WarehousesController;



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

Route::apiResource('categories',CategoriesController::class,["as"=>"api"]);
Route::get('/categoriessearch',[CategoriesController::class,'search']);

Route::apiResource('cities',CitiesController::class,["as"=>"api"]);
Route::put('citiesstatus',[CitiesController::class,'typestatus']);
Route::get('/citiessearch',[CitiesController::class,'search']);


Route::apiResource('days',DaysController::class,["as"=>"api"]);
Route::get('/dayssearch',[DaysController::class,'search']);

Route::apiResource('genders',GendersController::class,["as"=>"api"]);
Route::get('/genderssearch',[GendersController::class,'search']);

Route::apiResource('paymenttypes',PaymenttypesController::class,["as"=>"api"]);
Route::get('/paymenttypessearch',[PaymenttypesController::class,'search']);

Route::apiResource('stages',StagesController::class,["as"=>"api"]);
Route::get('/stagessearch',[StagesController::class,'search']);

Route::apiResource('statuses',StatusesController::class,["as"=>"api"]);
Route::get('/statusessearch',[StatusesController::class,'search']);

Route::apiResource('tags',TagsController::class,["as"=>"api"]);
Route::get('/tagssearch',[TagsController::class,'search']);

Route::apiResource('types',TypesController::class,["as"=>"api"]);
Route::get('/typessearch',[TypesController::class,'search']);


Route::apiResource('warehouses',WarehousesController::class,["as"=>"api"]);
Route::put('warehousesstatus',[WarehousesController::class,'typestatus']);
Route::get('/warehousessearch',[WarehousesController::class,'search']);

