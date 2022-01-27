<?php

use App\Models\Accorciato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccorciatoController;

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


Route::get('/{cognaome}', [AccorciatoController::class, 'reindirizzare']);
Route::get('/visita', [Accorciato::class, 'visita']);
Route::get('/tutto', [Accorciato::class, 'mostraTuttoliAccorciato']);
Route::put('/nuovo', [Accorciato::class, 'creaAccorciato']);

