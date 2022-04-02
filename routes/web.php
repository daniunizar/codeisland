<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IslaTucanaController;
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

