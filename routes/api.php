<?php

use App\Http\Controllers\CompaniesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/companies', [CompaniesController::class, 'index']);

Route::get('/companies/{id}', function (){
    return "companies id";
});

Route::get('/tasks', function (){
    return "task create";
});

Route::post('/tasks/create/', function (){
    return "task create";
});
