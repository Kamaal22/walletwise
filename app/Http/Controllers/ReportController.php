<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
      public function index(Request $request)
    {
        $user = auth()->user();

        $from = $request->input('from', now()->startOfMonth());
        $to   = $request->input('to', now()->endOfMonth());

        $transactions = $user->transactions()
            ->whereBetween('date', [$from, $to])
            ->with('category')
            ->get();

        $byCategory = $transactions->groupBy('category.name')->map->sum('amount');

        $income = $transactions->where('amount', '>', 0)->sum('amount');
        $expenses = abs($transactions->where('amount', '<', 0)->sum('amount'));

        return view('reports.index', compact('transactions', 'byCategory', 'income', 'expenses', 'from', 'to'));
    }
}
