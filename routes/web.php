<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LoginPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\DataBukuController;
use App\Http\Controllers\DataEbookController;
use App\Http\Controllers\DataPublisherController;
use App\Http\Controllers\DataCategoryController;
use App\Http\Controllers\DataPustakawanController;
use App\Http\Controllers\DataMemberController;
use App\Http\Controllers\PageMemberController;
use App\Http\Controllers\DataTransaksiController;
use App\Http\Controllers\DataReportController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\ConfirmPageController;
use App\Http\Controllers\DataPermissionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\SendEmailController;

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

Route::get('/', [LandingPageController::class, 'index']);
Route::post('/logged_in', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/selecting-user', [StaticPageController::class, 'selecting']);
Route::get('/account/confirm', [ConfirmPageController::class, 'confirmPage']);
Route::post('/account/confirm', [ConfirmPageController::class, 'confirmPageData']);
Route::post('/account/confirming/{user}', [ConfirmPageController::class, 'confirmingPageData']);
Route::post('/excel-report', [StaticPageController::class, 'excelReportMessage']);
Route::get('/about-dev', [StaticPageController::class, 'aboutDev']);
Route::get('/articles', [ArticlesController::class, 'articleLists']);
Route::get('/articles/view/{article}', [ArticlesController::class, 'articleRead']);
Route::post('/articles/search', [ArticlesController::class, 'search']);

Route::middleware(['auth:sanctum', 'verified', 'prevent-back-history'])->group(function () {

    // LIBRARIAN OR ADMIN PAGE
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/article-management', [ArticlesController::class, 'index']);
    Route::get('/article-management/create', [ArticlesController::class, 'create']);
    Route::post('/article-management/create', [ArticlesController::class, 'store']);
    Route::get('/article-management/edit/{article}', [ArticlesController::class, 'edit']);
    Route::post('/article-management/edit/{article}', [ArticlesController::class, 'update']);
    Route::delete('/article-management/delete/{article}', [ArticlesController::class, 'destroy']);
    Route::post('/article-management/search', [ArticlesController::class, 'searchFromLibrarian']);

    Route::get('/book', [DataBukuController::class, 'index']);
    Route::get('/book/detail/{book}', [DataBukuController::class, 'bookDetail']);
    Route::post('/book', [DataBukuController::class, 'store']);
    Route::post('/book/search', [DataBukuController::class, 'search']);
    Route::post('/book/import', [DataBukuController::class, 'importBook']);
    Route::get('/book/history/{book}', [DataBukuController::class, 'bookHistory']);
    Route::delete('/book/{book}', [DataBukuController::class, 'destroy']);
    Route::put('/book/{book}', [DataBukuController::class, 'update']);

    Route::get('/ebook', [DataEbookController::class, 'index']);
    Route::get('/ebook/detail/{ebook}', [DataEbookController::class, 'ebookDetail']);
    Route::post('/ebook', [DataEbookController::class, 'store']);
    Route::post('/ebook/search', [DataEbookController::class, 'search']);
    Route::post('/ebook/import', [DataEbookController::class, 'importEbook']);
    Route::delete('/ebook/{ebook}', [DataEbookController::class, 'destroy']);
    Route::put('/ebook/{ebook}', [DataEbookController::class, 'update']);

    Route::get('/publisher', [DataPublisherController::class, 'index']);
    Route::post('/publisher', [DataPublisherController::class, 'store']);
    Route::post('/publisher/search', [DataPublisherController::class, 'search']);
    Route::post('/publisher/import', [DataPublisherController::class, 'importPublisher']);
    Route::delete('/publisher/{publisher}', [DataPublisherController::class, 'destroy']);
    Route::put('/publisher/{publisher}', [DataPublisherController::class, 'update']);

    Route::get('/category', [DataCategoryController::class, 'index']);
    Route::post('/category', [DataCategoryController::class, 'store']);
    Route::post('/category/search', [DataCategoryController::class, 'search']);
    Route::post('/category/import', [DataCategoryController::class, 'importCategory']);
    Route::delete('/category/{categories}', [DataCategoryController::class, 'destroy']);
    Route::put('/category/{categories}', [DataCategoryController::class, 'update']);

    Route::get('/librarian', [DataPustakawanController::class, 'index']);
    Route::post('/librarian', [DataPustakawanController::class, 'store']);
    Route::post('/librarian/search', [DataPustakawanController::class, 'search']);
    Route::post('/librarian/import', [DataPustakawanController::class, 'importLibrarian']);
    Route::post('/librarian/reset-code/{librarian}', [DataPustakawanController::class, 'resetCode']);
    Route::delete('/librarian/{user}', [DataPustakawanController::class, 'destroy']);
    Route::put('/librarian/{user}', [DataPustakawanController::class, 'update']);
    Route::get('/librarian/detail/{librarian}', [DataPustakawanController::class, 'librarianDetail']);

    Route::get('/edit-profile', [DataPustakawanController::class, 'edit']);
    Route::post('/edit-profile', [DataPustakawanController::class, 'update']);

    Route::get('/change-password', [DataPustakawanController::class, 'editPass']);
    Route::post('/change-password', [DataPustakawanController::class, 'updatePass']);

    Route::get('/member', [DataMemberController::class, 'index']);
    Route::post('/member', [DataMemberController::class, 'store']);
    Route::post('/member/search', [DataMemberController::class, 'search']);
    Route::post('/member/import', [DataMemberController::class, 'importMember']);
    Route::post('/member/reset-code/{member}', [DataMemberController::class, 'resetCode']);
    Route::delete('/member/{member}', [DataMemberController::class, 'destroy']);
    Route::get('/member/history/{member}', [DataMemberController::class, 'memberHistory']);
    Route::get('/member/card/{user}', [StaticPageController::class, 'printCard']);
    Route::get('/member/detail/{member}', [DataMemberController::class, 'memberDetail']);

    Route::get('/transaction', [DataTransaksiController::class, 'index']);
    Route::get('/transaction/add', [DataTransaksiController::class, 'create']);
    Route::post('/transaction/add/book', [DataTransaksiController::class, 'createBook']);
    Route::post('/transaction/add/member', [DataTransaksiController::class, 'createMember']);
    Route::get('/transaction/add/reset', [DataTransaksiController::class, 'reset']);
    Route::post('/transaction/add/cancel', [DataTransaksiController::class, 'cancel']);
    Route::post('/transaction/add', [DataTransaksiController::class, 'store']);
    Route::post('/transaction/edit/{transaction}', [DataTransaksiController::class, 'update']);
    Route::post('/transaction/search', [DataTransaksiController::class, 'search']);
    Route::get('/transaction/return-book/{transaction}', [DataTransaksiController::class, 'returnBook']);
    Route::post('/transaction/return-book/{transaction}', [DataTransaksiController::class, 'returnBookUpdate']);
    Route::post('/check-member', [DataTransaksiController::class, 'checkMember']);
    Route::post('/check-book', [DataTransaksiController::class, 'checkBook']);
    Route::post('/transaction-check-book', [DataTransaksiController::class, 'checkBookTransaction']);
    Route::post('/check-detail', [DataTransaksiController::class, 'checkDetail']);
    Route::post('/check-detail-edit', [DataTransaksiController::class, 'checkDetailEdit']);
    Route::post('/late-transaction', [DataTransaksiController::class, 'lateTransaction']);
    
    Route::get('/report', [DataReportController::class, 'index']);
    Route::post('/report/search', [DataReportController::class, 'reportSearch']);
    Route::get('/report/late', [DataReportController::class, 'indexLate']);
    
    Route::get('/permission', [DataPermissionController::class, 'index']);
    Route::post('/permission/accept', [DataPermissionController::class, 'permissionAccept']);
    Route::post('/permission/refuse', [DataPermissionController::class, 'permissionRefuse']);
    Route::get('/permission/delete/expired', [DataPermissionController::class, 'deleteExpired']);
    Route::get('/permission/delete/refused', [DataPermissionController::class, 'deleteRefused']);

    Route::get('/config', [ConfigController::class, 'index']);
    Route::post('/config/return-config', [ConfigController::class, 'returnConfig']);
    Route::post('/config/data-list-config', [ConfigController::class, 'dataListConfig']);
    Route::post('/config/member-bg', [ConfigController::class, 'memberBg']);
    Route::post('/config/gallery', [ConfigController::class, 'galleryConfig']);

    Route::get('/pdf-report', [StaticPageController::class, 'pdfReport']);
    Route::get('/pdf-report-print', [StaticPageController::class, 'pdfReportPrint']);
    Route::post('/card-member', [StaticPageController::class, 'cardMember']);
    
    Route::get('/send-reminder/{transaction}', [SendEmailController::class, 'sendReminder']);
    
    // MEMBER PAGE
    Route::get('/member/dashboard', [PageMemberController::class, 'index']);

    Route::get('/member/edit-profile', [DataMemberController::class, 'edit']);
    Route::post('/member/edit-profile', [DataMemberController::class, 'update']);

    Route::get('/member/change-password', [DataMemberController::class, 'editPass']);
    Route::post('/member/change-password', [DataMemberController::class, 'updatePass']);

    Route::get('/member/book', [PageMemberController::class, 'book']);
    Route::get('/member/book/detail/{book}', [PageMemberController::class, 'bookDetail']);
    Route::post('/member/book/search', [PageMemberController::class, 'bookSearch']);
    
    Route::get('/member/ebook', [PageMemberController::class, 'ebook']);
    Route::get('/member/ebook/detail/{ebook}', [PageMemberController::class, 'ebookDetail']);
    Route::post('/member/ebook/permission/{ebook}', [DataPermissionController::class, 'store']);
    Route::post('/member/ebook/search', [PageMemberController::class, 'ebookSearch']);
    
    Route::get('/member/my-ebook', [PageMemberController::class, 'myEbook']);
    Route::get('/member/my-ebook/preview/{ebook}', [PageMemberController::class, 'myEbookPreview']);
});

