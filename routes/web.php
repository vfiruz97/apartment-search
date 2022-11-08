<?php

use App\Http\Controllers\Property\PropertyController;
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

Route::name('property.')->group(function () {
    Route::get('/', [PropertyController::class, 'index'])->name('index');
    Route::post('/property/search', [PropertyController::class, 'search'])->name('search');
});
