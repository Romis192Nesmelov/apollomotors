<?php

use App\Http\Controllers\Admin\AdminParserController;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Admin\AdminEditController;

use App\Http\Controllers\Admin\AdminBrandsController;
use App\Http\Controllers\Admin\AdminEditBrandController;
use App\Http\Controllers\Admin\AdminEditRepairController;

use App\Http\Controllers\Admin\AdminActionsController;
use App\Http\Controllers\Admin\AdminEditActionController;

use App\Http\Controllers\Admin\AdminRecordsController;
use App\Http\Controllers\Admin\AdminEditRecordController;

use App\Http\Controllers\Admin\AdminApiController;

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
    Route::get('/parser', AdminParserController::class);

    Route::get('/', [AdminBaseController::class, 'home'])->name('home');

    Route::get('/users/{slug?}', [AdminBaseController::class, 'users'])->name('users');
    Route::post('/edit-user', [AdminEditController::class, 'editUser'])->name('edit_user');
    Route::post('/delete-user', [AdminApiController::class, 'deleteUser'])->name('delete_user');

    Route::get('/contents/', [AdminBaseController::class, 'contents'])->name('contents');
    Route::post('/edit-content', [AdminEditController::class, 'editContent'])->name('edit_content');

    Route::get('/contacts/', [AdminBaseController::class, 'contacts'])->name('contacts');
    Route::post('/edit-contact', [AdminEditController::class, 'editContact'])->name('edit_contact');

    Route::get('/offer-repairs/{slug?}', [AdminBaseController::class, 'offerRepairs'])->name('offer_repairs');
    Route::post('/edit-offer-repair', [AdminEditController::class, 'editOfferRepair'])->name('edit_offer_repair');
    Route::post('/delete-offer-repair', [AdminApiController::class, 'deleteOfferRepair'])->name('delete_offer_repair');

    Route::get('/free-checks/{slug?}', [AdminBaseController::class, 'freeChecks'])->name('free_checks');
    Route::post('/edit-free-check', [AdminEditController::class, 'editFreeCheck'])->name('edit_free_check');
    Route::post('/delete-free-check', [AdminApiController::class, 'deleteFreeCheck'])->name('delete_free_check');

    Route::get('/checks/{slug?}', [AdminBaseController::class, 'checks'])->name('checks');
    Route::post('/edit-check', [AdminEditController::class, 'editCheck'])->name('edit_check');
    Route::post('/delete-check', [AdminApiController::class, 'deleteCheck'])->name('delete_check');

    Route::get('/prices/{slug?}', [AdminBaseController::class, 'prices'])->name('prices');
    Route::post('/edit-price', [AdminEditController::class, 'editPrice'])->name('edit_price');
    Route::post('/delete-price', [AdminApiController::class, 'deletePrice'])->name('delete_price');

    Route::get('/questions/{slug?}', [AdminBaseController::class, 'questions'])->name('questions');
    Route::post('/edit-question', [AdminEditController::class, 'editQuestion'])->name('edit_question');
    Route::post('/delete-question', [AdminApiController::class, 'deleteQuestion'])->name('delete_question');

    Route::get('/clients/{slug?}', [AdminBaseController::class, 'clients'])->name('clients');
    Route::post('/edit-client', [AdminEditController::class, 'editClient'])->name('edit_client');
    Route::post('/delete-client', [AdminApiController::class, 'deleteClient'])->name('delete_client');

    Route::get('/articles/{slug?}', [AdminBaseController::class, 'articles'])->name('articles');
    Route::post('/edit-article', [AdminEditController::class, 'editArticle'])->name('edit_article');
    Route::post('/delete-article', [AdminApiController::class, 'deleteArticle'])->name('delete_article');

    Route::get('/gallery/{folder?}/{subFolder?}', [AdminBaseController::class, 'gallery'])->name('gallery');
    Route::post('/add-image', [AdminEditController::class, 'addImage'])->name('add_image');
    Route::post('/delete-image', [AdminApiController::class, 'deleteImage'])->name('delete_image');

//    Route::get('/brands/{slug?}', [AdminBrandsController::class, 'brands'])->name('brands');
//    Route::post('/edit-brand', [AdminEditBrandController::class, 'editBrand'])->name('edit_brand');
//    Route::post('/delete-brand', [AdminApiController::class, 'deleteBrand'])->name('delete_brand');
//
//    Route::get('/brand-repair', [AdminBrandsController::class, 'brandRepair'])->name('brand_repair');
//    Route::get('/brand-maintenances', [AdminBrandsController::class, 'brandMaintenances'])->name('brand_maintenances');
//    Route::get('/brand-spare', [AdminBrandsController::class, 'brandSpare'])->name('brand_spare');
//
//    Route::post('/edit-brand-repair', [AdminEditBrandController::class, 'editBrandRepair'])->name('edit_brand_repair');
//    Route::post('/edit-brand-maintenances', [AdminEditBrandController::class, 'editBrandMaintenances'])->name('edit_brand_maintenances');
//    Route::post('/edit-brand-spare', [AdminEditBrandController::class, 'editBrandSpare'])->name('edit_brand_spare');
//
//    Route::get('/cars/{slug?}', [AdminBrandsController::class, 'cars'])->name('cars');
//    Route::post('/edit-car', [AdminEditBrandController::class, 'editCar'])->name('edit_car');
//    Route::post('/delete-car', [AdminApiController::class, 'deleteCar'])->name('delete_car');
//
//    Route::get('/car-repairs', [AdminBrandsController::class, 'carRepairs'])->name('car_repairs');
//    Route::get('/car-maintenance', [AdminBrandsController::class, 'carMaintenance'])->name('car_maintenance');
//    Route::get('/car-spare', [AdminBrandsController::class, 'carSpare'])->name('car_spare');
//
//    Route::post('/edit-car-repairs', [AdminEditBrandController::class, 'editCarRepairs'])->name('edit_car_repairs');
//    Route::post('/edit-car-maintenance', [AdminEditBrandController::class, 'editCarMaintenance'])->name('edit_car_maintenance');
//    Route::post('/edit-car-spare', [AdminEditBrandController::class, 'editCarSpare'])->name('edit_car_spare');
//
//    Route::get('/spares/{slug?}', [AdminBrandsController::class, 'spares'])->name('spares');
//    Route::post('/edit-spare', [AdminEditBrandController::class, 'editSpare'])->name('edit_spare');
//    Route::post('/delete-spare', [AdminApiController::class, 'deleteSpare'])->name('delete_spare');
//
//    Route::get('/actions/{slug?}', [AdminActionsController::class, 'actions'])->name('actions');
//    Route::post('/edit-action', [AdminEditActionController::class, 'editAction'])->name('edit_action');
//    Route::post('/delete-action', [AdminApiController::class, 'deleteAction'])->name('delete_action');
//
//    Route::get('/action-questions/{slug?}', [AdminActionsController::class, 'actionQuestions'])->name('action_questions');
//    Route::post('/edit-action-question', [AdminEditActionController::class, 'editActionQuestion'])->name('edit_action_question');
//    Route::post('/delete-action-question', [AdminApiController::class, 'deleteActionQuestion'])->name('delete_action_question');
//
//    Route::get('/repairs/{slug?}', [AdminBrandsController::class, 'repairs'])->name('repairs');
//    Route::post('/edit-repair', [AdminEditRepairController::class, 'editRepair'])->name('edit_repair');
//    Route::post('/delete-repair', [AdminApiController::class, 'deleteRepair'])->name('delete_repair');
//
//    Route::get('/sub-repairs/{slug?}', [AdminBrandsController::class, 'subRepairs'])->name('sub_repairs');
//    Route::post('/edit-sub-repair', [AdminEditRepairController::class, 'editSubRepair'])->name('edit_sub_repair');
//    Route::post('/delete-sub-repair', [AdminApiController::class, 'deleteSubRepair'])->name('delete_sub_repair');
//
//    Route::get('/recommended-works/{slug}', [AdminBrandsController::class, 'recommendedWorks'])->name('recommended_works');
//    Route::post('/add-recommended-work', [AdminEditRepairController::class, 'addRecommendedWork'])->name('add_recommended_work');
//    Route::post('/delete-recommended-work', [AdminApiController::class, 'deleteRecommendedWork'])->name('delete_recommended_work');
//
//    Route::get('/repair-images/{slug}', [AdminBrandsController::class, 'repairImages'])->name('repair_images');
//    Route::post('/add-repair-image', [AdminEditRepairController::class, 'addRepairImage'])->name('add_repair_image');
//    Route::post('/delete-repair-image', [AdminApiController::class, 'deleteRepairImage'])->name('delete_repair_image');
//
//    Route::get('/repair-spares/{slug}', [AdminBrandsController::class, 'repairSpares'])->name('repair_spares');
//    Route::post('/add-repair-spare', [AdminEditRepairController::class, 'addRepairSpare'])->name('add_repair_spare');
//    Route::post('/delete-repair-spare', [AdminApiController::class, 'deleteRepairSpare'])->name('delete_repair_spare');
//
//    Route::get('/mechanics/{slug?}', [AdminRecordsController::class, 'mechanics'])->name('mechanics');
//    Route::post('/edit-mechanic', [AdminEditRecordController::class, 'editMechanic'])->name('edit_mechanic');
//    Route::post('/edit-missing-mechanics', [AdminEditRecordController::class, 'editMissingMechanics'])->name('edit_missing_mechanics');
//    Route::post('/delete-mechanic', [AdminApiController::class, 'deleteMechanic'])->name('delete_mechanic');
//    Route::post('/change-idle-mechanic', [AdminApiController::class, 'changeIdleMechanic'])->name('change_idle_mechanic');
//
//    Route::get('/records/{slug?}', [AdminRecordsController::class, 'records'])->name('records');
//    Route::post('/edit-record', [AdminEditRecordController::class, 'editRecord'])->name('edit_record');
//    Route::post('/delete-record', [AdminEditRecordController::class, 'deleteRecord'])->name('delete_record');
});

