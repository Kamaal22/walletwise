<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ReportController;

// -----------------
// Guest / Auth routes
// -----------------
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Password reset
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

// -----------------
// Protected routes
// -----------------
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('accounts', AccountController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('budgets', BudgetController::class);
    Route::resource('reports', ReportController::class);
    // profile & settings
    Route::get('settings', [\App\Http\Controllers\SettingsController::class, 'edit'])->name('settings.edit');
    Route::post('settings', [\App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
    // optional profile routes (edit/update) could reuse SettingsController
    Route::get('profile', [\App\Http\Controllers\SettingsController::class, 'edit'])->name('profile.edit');
    Route::post('profile', [\App\Http\Controllers\SettingsController::class, 'update'])->name('profile.update');
    // mock export page
    Route::get('export', function(){ return view('export.index'); })->name('export.index');
    // server-side export endpoint
    Route::post('export', [\App\Http\Controllers\ExportController::class, 'export'])->name('export.post');
    // list and download generated exports
    Route::get('exports', [\App\Http\Controllers\ExportsController::class, 'index'])->name('exports.index');
    Route::get('exports/{export}/download', [\App\Http\Controllers\ExportsController::class, 'download'])->name('exports.download');
});
