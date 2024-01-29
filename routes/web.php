<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return view('home');
});

Route::post("/find", [APIController::class, 'get']);
Route::post("/add", [APIController::class, 'add']);
Route::post("/edit", [APIController::class, 'update']);
Route::post("/delete", [APIController::class, 'delete']);