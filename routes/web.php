<?php

use App\Http\Controllers\BaseController;
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

Route::get('/aktsii', [BaseController::class, 'actions'])->name('actions');
Route::get('/article', [BaseController::class, 'articles'])->name('articles');
Route::get('/kontakty', [BaseController::class, 'contacts'])->name('contacts');
Route::get('/privacy_policy', [BaseController::class, 'policy'])->name('privacy_policy');
