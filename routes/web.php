<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CashAccountController;
use App\Http\Controllers\Admin\CashTransactionCategoryController;
use App\Http\Controllers\Admin\CashTransactionController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\OfficerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserActivityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WitnessController;
use App\Http\Controllers\Public\ServiceOrderController as PublicServiceOrderController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\OnlyGuest;

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

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/admin', '/admin/dashboard');

Route::middleware([OnlyGuest::class])->group(function () {
    Route::get('admin/login', [AuthController::class, 'login'])->name('login');
    Route::post('admin/login', [AuthController::class, 'authenticate']);
    Route::get('track/{id}', [PublicServiceOrderController::class, 'track']);
});

Route::middleware([Authenticate::class, OnlyAdmin::class])->prefix('admin')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::controller(ReportController::class)->prefix('report')->group(function () {
        Route::get('', 'index');
    });

    Route::controller(CustomerController::class)->prefix('customer')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
        Route::get('detail/{id}', 'detail');
    });

    Route::controller(OrderController::class)->prefix('order')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
        Route::get('detail/{id}', 'detail');
    });

    Route::controller(SettingsController::class)->prefix('settings')->group(function () {
        Route::get('', 'edit');
        Route::post('save', 'save');
    });

    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::match(['get', 'post'], 'delete/{id}', 'delete');
        Route::match(['get', 'post'], 'profile', 'profile');
    });

    Route::controller(UserActivityController::class)->prefix('user-activity')->group(function () {
        Route::get('', 'index');
        Route::get('detail/{id}', 'detail');
        Route::get('delete/{id}', 'delete');
        Route::match(['get', 'post'],'clear', 'clear');
    });

    Route::controller(WitnessController::class)->prefix('witness')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
        Route::get('duplicate/{id}', 'duplicate');
    });

    Route::controller(OfficerController::class)->prefix('officer')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
        Route::get('duplicate/{id}', 'duplicate');
    });

    Route::controller(PartnerController::class)->prefix('partner')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
        Route::get('duplicate/{id}', 'duplicate');
    });

    Route::controller(ServiceController::class)->prefix('service')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
        Route::get('duplicate/{id}', 'duplicate');
    });

    Route::controller(ExpenseCategoryController::class)->prefix('expense-category')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
    });

    Route::controller(ExpenseController::class)->prefix('expense')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
    });

    Route::controller(CashTransactionCategoryController::class)->prefix('cash-transaction-category')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
    });

    Route::controller(CashTransactionController::class)->prefix('cash-transaction')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
    });

    Route::controller(CashAccountController::class)->prefix('cash-account')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
    });

    Route::get('refresh-csrf', function () {
        return csrf_token();
    });

    Route::controller(AjaxController::class)->prefix('ajax')->group(function() {
        Route::post('add-cash-transaction-category', 'addCashTransactionCategory');
    });
});
