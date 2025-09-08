<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Eager load accounts, budgets, transactions with category
        $user->load(['accounts', 'budgets', 'transactions.category']);

        // Calculate total spent per budget
        $totalSpent = $user->budgets->sum(fn($budget) => $budget->spent()); // assuming spent() method exists
        $totalBudget = $user->budgets->sum('amount');

        $summary = [
            'income'     => $user->transactions()->where('amount', '>', 0)->sum('amount'),
            'expenses'   => abs($user->transactions()->where('amount', '<', 0)->sum('amount')),
            'budgetUsed' => $totalBudget > 0
                ? round(($totalSpent / $totalBudget) * 100, 2)
                : 0,
            'accounts'   => $user->accounts()->count(),
        ];

        // Recent transactions for sidebar
        $recentTransactions = $user->transactions()
            ->with('category', 'account')
            ->latest('date')
            ->take(5)
            ->get();

        return view('dashboard', compact('user', 'summary', 'recentTransactions'));
    }
}
