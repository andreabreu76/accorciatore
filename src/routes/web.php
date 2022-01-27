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

Route::get('/', function () {
    return response()->json([
        'stato'=>'Attivo',
        'data'=>date('Y-m-d H:i:s'),
        'ip'=>request()->ip(),
        'browser'=>request()->header('User-Agent'),
        'titolo' => 'Accorciato',
        'descrizione' => 'Sfida di sviluppo per Tiago Perreli',
    ], 200);
});
