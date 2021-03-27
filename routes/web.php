<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\FabricanteController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoFabCatController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\UserController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::apiResource('/api/producto',ProductoController::class);
Route::apiResource('/api/tecnico',TecnicoController::class);
Route::apiResource('/api/fabricante',FabricanteController::class);
Route::apiResource('/api/categoria',CategoriaController::class);
Route::apiResource('/api/cliente',ClienteController::class);
Route::apiResource('/api/user',UserController::class);
Route::apiResource('/api/producto',ProductoController::class);
Route::apiResource('/api/orden',OrdenController::class);
Route::apiResource('/api/componente',ComponenteController::class);
//->middleware('cors')