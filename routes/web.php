<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\VisitorLogController;
use App\Services\SitePaletteService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('portfolio', [
        'sitePalettes' => SitePaletteService::palettesForFeatured(),
    ]);
})->name('home');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('admin.login.attempt');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->middleware('admin.auth')
    ->name('admin.logout');

Route::get('/admin/forgot-password', [AdminAuthController::class, 'showForgotPassword'])
    ->name('admin.forgot-password');
Route::post('/admin/forgot-password', [AdminAuthController::class, 'sendOtp'])
    ->middleware('throttle:5,1')
    ->name('admin.forgot-password.send-otp');

Route::get('/admin/reset-password', [AdminAuthController::class, 'showResetPassword'])
    ->name('admin.reset-password.form');
Route::post('/admin/reset-password', [AdminAuthController::class, 'resetPassword'])
    ->middleware('throttle:5,1')
    ->name('admin.reset-password.update');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware('admin.auth')
    ->name('admin.dashboard');
Route::post('/admin/categories', [AdminDashboardController::class, 'storeCategory'])
    ->middleware('admin.auth')
    ->name('admin.categories.store');
Route::put('/admin/categories/{category}', [AdminDashboardController::class, 'updateCategory'])
    ->middleware('admin.auth')
    ->name('admin.categories.update');
Route::delete('/admin/categories/{category}', [AdminDashboardController::class, 'deleteCategory'])
    ->middleware('admin.auth')
    ->name('admin.categories.delete');
Route::post('/admin/expenses', [AdminDashboardController::class, 'storeExpense'])
    ->middleware('admin.auth')
    ->name('admin.expenses.store');
Route::put('/admin/expenses/{expense}', [AdminDashboardController::class, 'updateExpense'])
    ->middleware('admin.auth')
    ->name('admin.expenses.update');
Route::delete('/admin/expenses/{expense}', [AdminDashboardController::class, 'deleteExpense'])
    ->middleware('admin.auth')
    ->name('admin.expenses.delete');
Route::get('/admin/expenses/export/csv', [AdminDashboardController::class, 'exportExpensesCsv'])
    ->middleware('admin.auth')
    ->name('admin.expenses.export.csv');
Route::get('/admin/expenses/export/excel', [AdminDashboardController::class, 'exportExpensesExcel'])
    ->middleware('admin.auth')
    ->name('admin.expenses.export.excel');
Route::post('/admin/incomes', [AdminDashboardController::class, 'storeIncome'])
    ->middleware('admin.auth')
    ->name('admin.incomes.store');
Route::put('/admin/incomes/{income}', [AdminDashboardController::class, 'updateIncome'])
    ->middleware('admin.auth')
    ->name('admin.incomes.update');
Route::delete('/admin/incomes/{income}', [AdminDashboardController::class, 'deleteIncome'])
    ->middleware('admin.auth')
    ->name('admin.incomes.delete');
Route::post('/admin/credit-cards', [AdminDashboardController::class, 'storeCreditCard'])
    ->middleware('admin.auth')
    ->name('admin.credit-cards.store');
Route::put('/admin/credit-cards/{creditCard}', [AdminDashboardController::class, 'updateCreditCard'])
    ->middleware('admin.auth')
    ->name('admin.credit-cards.update');
Route::delete('/admin/credit-cards/{creditCard}', [AdminDashboardController::class, 'deleteCreditCard'])
    ->middleware('admin.auth')
    ->name('admin.credit-cards.delete');
Route::post('/admin/debit-cards', [AdminDashboardController::class, 'storeDebitCard'])
    ->middleware('admin.auth')
    ->name('admin.debit-cards.store');
Route::put('/admin/debit-cards/{debitCard}', [AdminDashboardController::class, 'updateDebitCard'])
    ->middleware('admin.auth')
    ->name('admin.debit-cards.update');
Route::delete('/admin/debit-cards/{debitCard}', [AdminDashboardController::class, 'deleteDebitCard'])
    ->middleware('admin.auth')
    ->name('admin.debit-cards.delete');
Route::put('/admin/cash-balance', [AdminDashboardController::class, 'updateCashBalance'])
    ->middleware('admin.auth')
    ->name('admin.cash-balance.update');
Route::post('/admin/stocks', [AdminDashboardController::class, 'storeStock'])
    ->middleware('admin.auth')
    ->name('admin.stocks.store');
Route::put('/admin/stocks/{stock}', [AdminDashboardController::class, 'updateStock'])
    ->middleware('admin.auth')
    ->name('admin.stocks.update');
Route::delete('/admin/stocks/{stock}', [AdminDashboardController::class, 'deleteStock'])
    ->middleware('admin.auth')
    ->name('admin.stocks.delete');
Route::post('/admin/savings-adjustments', [AdminDashboardController::class, 'storeSavingsAdjustment'])
    ->middleware('admin.auth')
    ->name('admin.savings-adjustments.store');
Route::put('/admin/savings-adjustments/{adjustment}', [AdminDashboardController::class, 'updateSavingsAdjustment'])
    ->middleware('admin.auth')
    ->name('admin.savings-adjustments.update');
Route::delete('/admin/savings-adjustments/{adjustment}', [AdminDashboardController::class, 'deleteSavingsAdjustment'])
    ->middleware('admin.auth')
    ->name('admin.savings-adjustments.delete');
Route::post('/admin/net-worth', [AdminDashboardController::class, 'storeNetWorth'])
    ->middleware('admin.auth')
    ->name('admin.net-worth.store');
Route::put('/admin/net-worth/{entry}', [AdminDashboardController::class, 'updateNetWorth'])
    ->middleware('admin.auth')
    ->name('admin.net-worth.update');
Route::delete('/admin/net-worth/{entry}', [AdminDashboardController::class, 'deleteNetWorth'])
    ->middleware('admin.auth')
    ->name('admin.net-worth.delete');
Route::post('/admin/weight-logs', [AdminDashboardController::class, 'storeWeightLog'])
    ->middleware('admin.auth')
    ->name('admin.weight-logs.store');
Route::put('/admin/weight-logs/{weightLog}', [AdminDashboardController::class, 'updateWeightLog'])
    ->middleware('admin.auth')
    ->name('admin.weight-logs.update');
Route::delete('/admin/weight-logs/{weightLog}', [AdminDashboardController::class, 'deleteWeightLog'])
    ->middleware('admin.auth')
    ->name('admin.weight-logs.delete');
Route::put('/admin/todos/sync', [AdminDashboardController::class, 'syncTodos'])
    ->middleware('admin.auth')
    ->name('admin.todos.sync');
Route::get('/admin/dashboard-image/{slug}', [AdminDashboardController::class, 'dashboardImage'])
    ->middleware('admin.auth')
    ->name('admin.dashboard.image');

Route::get('/admin/visitors', [VisitorLogController::class, 'index'])
    ->middleware('admin.auth')
    ->name('admin.visitors.index');
