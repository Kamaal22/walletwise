<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ReportController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/accounts', [AccountController::class, 'index'])->name('accounts');
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
Route::get('/budgets', [BudgetController::class, 'index'])->name('budgets');
Route::get('/reports', [ReportController::class, 'index'])->name('reports');
