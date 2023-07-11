<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [BaseController::class, 'index'])->name('home');
Route::get('/o-kompanii', [BaseController::class, 'about'])->name('about');
Route::get('/korporativnym-klientam', [BaseController::class, 'corporativeClients'])->name('cc');

//Route::get('/parser', [BrandController::class, 'parser'])->name('parser');

Route::get('/remont/{slug?}', [BrandController::class, 'repair'])->name('repair');
Route::get('/tekhobsluzhivanie/{slug?}', [BrandController::class, 'maintenance'])->name('maintenance');
Route::get('/zapchasti/{slug?}', [BrandController::class, 'spares'])->name('spares');

Route::get('/aktsii', [BaseController::class, 'actions'])->name('actions');
Route::get('/article/{slug?}', [BaseController::class, 'articles'])->name('articles');
Route::get('/kontakty', [BaseController::class, 'contacts'])->name('contacts');
Route::get('/privacy_policy', [BaseController::class, 'policy'])->name('privacy_policy');

Route::post('/request', [FeedbackController::class, 'sendRequest'])->name('request');
