<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
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
Route::get('/search', [BaseController::class, 'search'])->name('search');
Route::get('/o-kompanii', [BaseController::class, 'about'])->name('about');
Route::get('/korporativnym-klientam', [BaseController::class, 'corporateClients'])->name('cc');

//Route::get('/parser', [BrandController::class, 'parser'])->name('parser');

Route::get('/remont/{brand?}/{car?}/{job?}', [BrandController::class, 'repair'])->name('repair');
Route::get('/tekhobsluzhivanie/{brand?}/{car?}', [BrandController::class, 'maintenance'])->name('maintenance');
Route::get('/zapchasti/{brand?}/{car?}', [BrandController::class, 'spares'])->name('spare');

Route::get('/aktsii/{action?}', [BaseController::class, 'actions'])->name('actions');
Route::get('/article/{slug?}', [BaseController::class, 'articles'])->name('articles');
Route::get('/kontakty', [BaseController::class, 'contacts'])->name('contacts');
Route::get('/privacy_policy', [BaseController::class, 'policy'])->name('privacy_policy');

Route::post('/request', [FeedbackController::class, 'sendRequest'])->name('request');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('enter');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'home'])->name('home');

    Route::get('/users/{slug?}', [AdminController::class, 'users'])->name('users');
    Route::post('/edit-user', [AdminController::class, 'editUser'])->name('edit_user');
    Route::post('/delete-user', [AdminController::class, 'deleteUser'])->name('delete_user');

    Route::get('/contents/', [AdminController::class, 'contents'])->name('contents');
    Route::post('/edit-content', [AdminController::class, 'editContent'])->name('edit_content');

    Route::get('/contacts/', [AdminController::class, 'contacts'])->name('contacts');
    Route::post('/edit-contact', [AdminController::class, 'editContact'])->name('edit_contact');

    Route::get('/offer-repairs/{slug?}', [AdminController::class, 'offerRepairs'])->name('offer_repairs');
    Route::post('/edit-offer-repair', [AdminController::class, 'editOfferRepair'])->name('edit_offer_repair');
    Route::post('/delete-offer-repair', [AdminController::class, 'deleteOfferRepair'])->name('delete_offer_repair');

    Route::get('/free-checks/{slug?}', [AdminController::class, 'freeChecks'])->name('free_checks');
    Route::post('/edit-free-check', [AdminController::class, 'editFreeCheck'])->name('edit_free_check');
    Route::post('/delete-free-check', [AdminController::class, 'deleteFreeCheck'])->name('delete_free_check');

    Route::get('/checks/{slug?}', [AdminController::class, 'checks'])->name('checks');
    Route::post('/edit-check', [AdminController::class, 'editCheck'])->name('edit_check');
    Route::post('/delete-check', [AdminController::class, 'deleteCheck'])->name('delete_check');

    Route::get('/prices/{slug?}', [AdminController::class, 'prices'])->name('prices');
    Route::post('/edit-price', [AdminController::class, 'editPrice'])->name('edit_price');
    Route::post('/delete-price', [AdminController::class, 'deletePrice'])->name('delete_price');

    Route::get('/questions/{slug?}', [AdminController::class, 'questions'])->name('questions');
    Route::post('/edit-question', [AdminController::class, 'editQuestion'])->name('edit_question');
    Route::post('/delete-question', [AdminController::class, 'deleteQuestion'])->name('delete_question');

    Route::get('/clients/{slug?}', [AdminController::class, 'clients'])->name('clients');
    Route::post('/edit-client', [AdminController::class, 'editClient'])->name('edit_client');
    Route::post('/delete-client', [AdminController::class, 'deleteClient'])->name('delete_client');

    Route::get('/articles/{slug?}', [AdminController::class, 'articles'])->name('articles');
    Route::post('/edit-article', [AdminController::class, 'editArticle'])->name('edit_article');
    Route::post('/delete-article', [AdminController::class, 'deleteArticle'])->name('delete_article');
});

