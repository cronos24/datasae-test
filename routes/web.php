<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JugadoresController;
use App\Http\Controllers\RuletaController;

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

Route::get('jugadores/refresh', [JugadoresController::class, 'refresh']);
Route::get('ruletas/refresh', [RuletaController::class, 'refresh']);


Route::get('/', function () {
    return view('index');
});




