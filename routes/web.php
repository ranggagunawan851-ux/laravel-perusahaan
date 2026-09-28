<?php

use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\ConsultationController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\ServiceController;
use App\Http\Controllers\Back\PortofolioController;
use App\Http\Controllers\Front\ArticleController as FrontArticleController;
use App\Http\Controllers\Front\PortofolioController as FrontPortofolioController;
use App\Http\Controllers\Front\ServiceController as FrontServiceController;
// use App\Http\Controllers\Front\CategoryController as FrontCategoryController;
use App\Http\Controllers\Front\ConsultationController as FrontConsultationController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [ContactController::class, 'index']);

Route::get('/p/{slug}', [FrontArticleController::class, 'show']);
Route::get('/articles', [FrontArticleController::class, 'index']);
Route::post('/articles/search', [FrontArticleController::class, 'index'])->name('search');

// // Ganti /service/{id} menjadi /services/{id} (Tambahkan huruf 's')
// Route::get('/services/{slug}', [FrontServiceController::class, 'show'])->name('front.service.show');

Route::get('/port/{slug}', [FrontPortofolioController::class, 'show']);
Route::get('/portofolios', [FrontPortofolioController::class, 'index']);
Route::post('/portofolios/src', [FrontPortofolioController::class, 'index'])->name('src');

Route::get('/services/{slug}', [FrontServiceController::class, 'show'])->name('front.service.show');
Route::get('/services', [FrontServiceController::class, 'index']);
Route::post('/services/srch', [FrontServiceController::class, 'index'])->name('srch');

Route::get('/track-consultation', [FrontConsultationController::class, 'index'])->name('front.consultation.track');
Route::post('/track-consultation/check', [FrontConsultationController::class, 'check'])->name('front.consultation.check');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('categories', CategoryController::class)->only([
        'index', 'store', 'update', 'destroy'
    ]);
    Route::resource('article', ArticleController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('portofolio', PortofolioController::class);

    // Taruh route export-excel DI ATAS Route::resource
    Route::get('/consultation/export-excel', [ConsultationController::class, 'exportExcel'])->name('consultation.export-excel');
    Route::resource('consultation', ConsultationController::class);
});
Route::post('/consultation/store', [ConsultationController::class, 'storePublic'])->name('consultation.storePublic');

Route::put('/consultation/{consultation}/status', [ConsultationController::class, 'updateStatus'])
    ->name('consultation.update-status');

Auth::routes();

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['guest']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });
