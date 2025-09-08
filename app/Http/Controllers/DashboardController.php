<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::get()->first();

        $budgets = $user->budgets; // eager load budgets
        $totalSpent = $budgets->sum(fn($budget) => $budget->spent()); // works whether spent is a method or accessor
        $totalBudget = $budgets->sum('amount');

        $summary = [
            'income'     => $user->transactions()->where('amount', '>', 0)->sum('amount'),
            'expenses'   => abs($user->transactions()->where('amount', '<', 0)->sum('amount')),
            'budgetUsed' => $totalBudget > 0
                ? round(($totalSpent / $totalBudget) * 100, 2)
                : 0,
            'accounts'   => $user->accounts()->count(),
        ];


        $recentTransactions = $user->transactions()
            ->with(['category', 'account'])
            ->latest('date')
            ->take(5)
            ->get();

        return view('dashboard', compact('summary', 'recentTransactions'));
    }
}
