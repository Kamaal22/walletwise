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

        // Eager load accounts and budgets
        $user->load(['accounts', 'budgets']);

        // Total balance: sum of each account's current balance (uses helper)
        $totalBalance = $user->accounts->sum(fn($a) => $a->currentBalance());

        // Income / expenses for current month
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $income = $user->transactions()->whereBetween('date', [$startOfMonth, $endOfMonth])->where('amount', '>', 0)->sum('amount');
        $expenses = abs($user->transactions()->whereBetween('date', [$startOfMonth, $endOfMonth])->where('amount', '<', 0)->sum('amount'));

        // Budget usage overall
        $totalSpent = $user->budgets->sum(fn($budget) => $budget->spent());
        $totalBudget = $user->budgets->sum('amount');

        $summary = [
            'total_balance' => $totalBalance,
            'income' => $income,
            'expenses' => $expenses,
            'budgetUsed' => $totalBudget > 0 ? round(($totalSpent / $totalBudget) * 100, 2) : 0,
            'accounts' => $user->accounts->count(),
        ];

        // Recent transactions for sidebar (latest 8)
        $recentTransactions = $user->transactions()
            ->with('category', 'account')
            ->latest('date')
            ->take(8)
            ->get()
            ->map(fn($t) => [
                'id' => $t->id,
                'date' => $t->date,
                'account' => $t->account?->name,
                'category' => $t->category?->name,
                'description' => $t->description,
                'amount' => $t->amount,
            ]);

        // Prepare last 6 months labels and expense dataset for chart
        $labels = [];
        $expenseData = [];
        for ($i = 5; $i >= 0; $i--) {
            $dt = now()->subMonths($i);
            $labels[] = $dt->format('M');
            $monthStart = $dt->copy()->startOfMonth();
            $monthEnd = $dt->copy()->endOfMonth();
            $val = $user->transactions()->whereBetween('date', [$monthStart, $monthEnd])->where('amount', '<', 0)->sum('amount');
            $expenseData[] = abs($val);
        }

        return view('dashboard', compact('user', 'summary', 'recentTransactions', 'labels', 'expenseData'));
    }
}
