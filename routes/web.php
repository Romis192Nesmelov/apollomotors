<?php

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Admin\AdminBrandsController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LoginController;
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
    Route::get('/', [AdminBaseController::class, 'home'])->name('home');

    Route::get('/users/{slug?}', [AdminBaseController::class, 'users'])->name('users');
    Route::post('/edit-user', [AdminBaseController::class, 'editUser'])->name('edit_user');
    Route::post('/delete-user', [AdminBaseController::class, 'deleteUser'])->name('delete_user');

    Route::get('/contents/', [AdminBaseController::class, 'contents'])->name('contents');
    Route::post('/edit-content', [AdminBaseController::class, 'editContent'])->name('edit_content');

    Route::get('/contacts/', [AdminBaseController::class, 'contacts'])->name('contacts');
    Route::post('/edit-contact', [AdminBaseController::class, 'editContact'])->name('edit_contact');

    Route::get('/offer-repairs/{slug?}', [AdminBaseController::class, 'offerRepairs'])->name('offer_repairs');
    Route::post('/edit-offer-repair', [AdminBaseController::class, 'editOfferRepair'])->name('edit_offer_repair');
    Route::post('/delete-offer-repair', [AdminBaseController::class, 'deleteOfferRepair'])->name('delete_offer_repair');

    Route::get('/free-checks/{slug?}', [AdminBaseController::class, 'freeChecks'])->name('free_checks');
    Route::post('/edit-free-check', [AdminBaseController::class, 'editFreeCheck'])->name('edit_free_check');
    Route::post('/delete-free-check', [AdminBaseController::class, 'deleteFreeCheck'])->name('delete_free_check');

    Route::get('/checks/{slug?}', [AdminBaseController::class, 'checks'])->name('checks');
    Route::post('/edit-check', [AdminBaseController::class, 'editCheck'])->name('edit_check');
    Route::post('/delete-check', [AdminBaseController::class, 'deleteCheck'])->name('delete_check');

    Route::get('/prices/{slug?}', [AdminBaseController::class, 'prices'])->name('prices');
    Route::post('/edit-price', [AdminBaseController::class, 'editPrice'])->name('edit_price');
    Route::post('/delete-price', [AdminBaseController::class, 'deletePrice'])->name('delete_price');

    Route::get('/questions/{slug?}', [AdminBaseController::class, 'questions'])->name('questions');
    Route::post('/edit-question', [AdminBaseController::class, 'editQuestion'])->name('edit_question');
    Route::post('/delete-question', [AdminBaseController::class, 'deleteQuestion'])->name('delete_question');

    Route::get('/clients/{slug?}', [AdminBaseController::class, 'clients'])->name('clients');
    Route::post('/edit-client', [AdminBaseController::class, 'editClient'])->name('edit_client');
    Route::post('/delete-client', [AdminBaseController::class, 'deleteClient'])->name('delete_client');

    Route::get('/articles/{slug?}', [AdminBaseController::class, 'articles'])->name('articles');
    Route::post('/edit-article', [AdminBaseController::class, 'editArticle'])->name('edit_article');
    Route::post('/delete-article', [AdminBaseController::class, 'deleteArticle'])->name('delete_article');

    Route::get('/gallery/{folder?}/{subFolder?}', [AdminBaseController::class, 'gallery'])->name('gallery');
    Route::post('/add-image', [AdminBaseController::class, 'addImage'])->name('add_image');
    Route::post('/delete-image', [AdminBaseController::class, 'deleteImage'])->name('delete_image');

    Route::get('/brands/{slug?}', [AdminBrandsController::class, 'brands'])->name('brands');
    Route::post('/edit-brand', [AdminBrandsController::class, 'editBrand'])->name('edit_brand');
    Route::post('/delete-brand', [AdminBrandsController::class, 'deleteBrand'])->name('delete_brand');

    Route::get('/brand-repair', [AdminBrandsController::class, 'brandRepair'])->name('brand_repair');
    Route::get('/brand-maintenances', [AdminBrandsController::class, 'brandMaintenances'])->name('brand_maintenances');
    Route::get('/brand-spare', [AdminBrandsController::class, 'brandSpare'])->name('brand_spare');

    Route::post('/edit-brand-repair', [AdminBrandsController::class, 'editBrandRepair'])->name('edit_brand_repair');
    Route::post('/edit-brand-maintenances', [AdminBrandsController::class, 'editBrandMaintenances'])->name('edit_brand_maintenances');
    Route::post('/edit-brand-spare', [AdminBrandsController::class, 'editBrandSpare'])->name('edit_brand_spare');

    Route::get('/cars/{slug?}', [AdminBrandsController::class, 'cars'])->name('cars');
    Route::post('/edit-car', [AdminBrandsController::class, 'editCar'])->name('edit_car');
    Route::post('/delete-car', [AdminBrandsController::class, 'deleteCar'])->name('delete_car');
});

