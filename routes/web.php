<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartasController;
use App\Http\Controllers\SettingController;

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

Route::get('', function () {
    return view('index');
});

Route::resource('carta', CartasController::Class);
Route::get('carta/view/{id}', [CartasController::class, 'view'])-> name ('carta.view');
Route::get('setting', [SettingController::class, 'index'])-> name ('setting.index');
Route::put('setting', [SettingController::class, 'update'])-> name ('setting.update');

