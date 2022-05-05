<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IslaTucanaController;
use App\Http\Controllers\AdivinaLaPalabra\AdivinaLaPalabraController;
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
    return view('welcome');
});

Route::get('/isla-tucana/newGame', [IslaTucanaController::class, 'newGame'])->name('isla-tucana.newGame');
Route::get('/isla-tucana', [IslaTucanaController::class, 'index'])->name('isla-tucana');
Route::get('/adivina-la-palabra/newGame', [AdivinaLaPalabraController::class, 'newGame'])->name('adivina-la-palabra.newGame');
Route::get('/adivina-la-palabra', [AdivinaLaPalabraController::class, 'index'])->name('adivina-la-palabra');

