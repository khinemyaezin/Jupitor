<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ArticleHeaderController;
use App\Http\Controllers\Admin\CompanyInfoController;
use App\Http\Controllers\admin\CarouselController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\admin\ThemeGroupController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\GoogleController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Auth::routes();


Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.index');
Route::get('/admin/headlines', [GroupController::class, 'all'])->name('admin.group.all');
Route::get('/admin/headline', [GroupController::class, 'index'])->name('admin.group.index');
Route::post('/admin/headline', [ArticleHeaderController::class, 'create'])->name('admin.article_header.create');
Route::get('/admin/headline/{groupid}', [GroupController::class, 'getById'])->name('admin.group.getById');
Route::put('/admin/headline/{groupid}', [GroupController::class, 'update'])->name('admin.group.update');
Route::get('/admin/headline/{groupid}/subheading', [ArticleController::class, 'index'])->name('admin.article.index');
Route::post('/admin/headline/{groupid}/subheading', [ArticleController::class, 'create'])->name('admin.article.create');
Route::get('/admin/headline/{groupid}/subheading/{articleid}', [ArticleController::class, 'getById'])->name('admin.article.getById')
    ->where('groupid', '[0-9]+|new+')->where('articleid', '[0-9]+|new+');
Route::put('/admin/headline/{groupid}/subheading/{articleid}', [ArticleHeaderController::class, 'update'])
    ->name('admin.article_header.update');
Route::delete('/admin/headline/{groupid}/subheading/{articleid}', [ArticleController::class, 'delete'])->name('admin.article.delete')
    ->where('groupid', '[0-9]+|new+')->where('articleid', '[0-9]+|new+');

Route::get('/admin/themes', [ThemeController::class, 'all'])->name('admin.theme.all');
Route::get('/admin/theme/{themeid}', [ThemeController::class, 'getById'])->name('admin.theme.getById');
Route::post('/admin/theme', [ThemeController::class, 'create'])->name('admin.theme.create');
Route::get('/admin/theme', [ThemeController::class, 'index'])->name('admin.theme.index');
Route::put('/admin/theme/{themeid}', [ThemeController::class, 'update'])->name('admin.theme.update');

Route::get('/admin/carousels', [CarouselController::class, 'index'])->name('admin.forehead.index');
Route::post('/admin/carousel', [CarouselController::class, 'updateChild'])->name('admin.forehead.updateChild');
Route::post('/admin/carousel/header', [CarouselController::class, 'updateParent'])->name('admin.forehead.updateParent');
Route::post('/admin/headlines/sorting', [GroupController::class, 'reOrder']);

Route::get('/admin/setting', [SettingController::class, 'index'])->name('admin.info.index');
Route::post('/admin/setting/info', [CompanyInfoController::class, 'create'])->name('admin.info.create');
Route::put('/admin/setting/info', [CompanyInfoController::class, 'update'])->name('admin.info.update');
Route::get('/admin/setting/account/reset', [AuthController::class, 'resetAccount'])->name('admin.account.reset');
Route::put('/admin/setting/account', [AuthController::class, 'updateAccount'])->name('admin.account.update');
Route::put('/admin/setting/account/password', [AuthController::class, 'changePassword'])->name('admin.password.change');



Route::get('/admin/quotations', [QuotationController::class, 'index'])->name('admin.quotation.index');
Route::delete('/admin/quotation/{id}', [QuotationController::class, 'delete'])->name('admin.quotation.delete')
    ->where('id', '[0-9]+');
Route::get('/admin/quotation/{id}', [QuotationController::class, 'getById'])->name('admin.quotation.getById')
    ->where('id', '[0-9]+');

Route::get('/admin/theme-group', [ThemeGroupController::class, 'index'])->name('admin.theme_group.index');
Route::post('/admin/theme-group', [ThemeGroupController::class, 'create'])->name('admin.theme_group.create');

Route::get('/admin/types', [TypeController::class, 'all'])->name('admin.type.all');
Route::get('/admin/type/{id}', [TypeController::class, 'getById'])->name('admin.type.getById')
    ->where('id', '[0-9]+');
Route::post('/admin/type', [TypeController::class, 'create'])->name('admin.type.create');
Route::get('/admin/type', [TypeController::class, 'index'])->name('admin.type.index');
Route::put('/admin/type/{id}', [TypeController::class, 'update'])->name('admin.type.update')
    ->where('id', '[0-9]+');
Route::delete('/admin/type/{id}', [TypeController::class, 'delete'])->name('admin.type.delete')
    ->where('id', '[0-9]+');

Route::get('/api/types', [TypeController::class, 'jsonAll'])->name('api.type.all');
Route::get('/api/themes', [ThemeController::class, 'jsonAll'])->name('api.theme.jsonAll');
Route::get('/api/theme/parent/{pid}/children', [ThemeController::class, 'allByParentId'])->name('api.theme.allByParentId');
Route::post('/api/forehead/carousel', [CarouselController::class, 'sortingCarousels'])->name('api.forehead.sortingCarousels');
Route::delete('/api/forehead/carousel/{id}', [CarouselController::class, 'deleteCarousel'])->name('api.forehead.deleteCarousel');
Route::get('/api/group/type/identify', [GroupController::class, 'checkSystemPageDuplicate'])->name('api.type.checkSystemPageDuplicate');
Route::put('/api/group/{groupid}/status', [GroupController::class, 'updateStatus'])->name('api.group.updateStatus');
Route::delete('/api/group/{groupid}', [GroupController::class, 'delete'])->name('api.group.deleteById');
Route::put('/api/quotation/{id}/status', [QuotationController::class, 'changeStatus'])->name('api.quotation.changeStatus');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/admin/quotations/export', [QuotationController::class, 'export'])->name('admin.quotations.export');


Route::get('/contact', [ContactUsController::class, 'index'])->name('contactus.index');
Route::post('/contact', [ContactUsController::class, 'create'])->name('contactus.create');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/{typeid}', [PageController::class, 'groupInfo'])->name('page.groupInfo');
Route::get('/{typeid}/{groupid}/{articleid}', [PageController::class, 'articleInfo'])->name('page.articleInfo')
    ->where('groupid', '[0-9]+')->where('articleid', '[0-9]+');
