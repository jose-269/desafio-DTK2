<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RyMController;

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
Route::get('/', [RyMController::class, 'getData'])->name('index');
Route::get('/characters/{id}', [RyMController::class, 'getCharacterDetails'])->name('character.details');

