<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = auth()->user()->transactions()
            ->with(['category', 'account'])
            ->latest('date')
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::all();
        $accounts = auth()->user()->accounts;
        return view('transactions.create', compact('categories', 'accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_id'  => 'required|exists:accounts,id',
            'category_id' => 'required|exists:categories,id',
            'amount'      => 'required|numeric',
            'date'        => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        auth()->user()->transactions()->create($request->only(
            'account_id', 'category_id', 'amount', 'date', 'description'
        ));

        return redirect()->route('transactions.index')->with('success', 'Transaction added.');
    }

    public function edit(Transaction $transaction)
    {
    // Ensure the transaction belongs to the current user
    if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::all();
    $accounts = Auth::user()->accounts;

        return view('transactions.edit', compact('transaction', 'categories', 'accounts'));
    }

    public function update(Request $request, Transaction $transaction)
    {
    if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'account_id'  => 'required|exists:accounts,id',
            'category_id' => 'required|exists:categories,id',
            'amount'      => 'required|numeric',
            'date'        => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        $transaction->update($request->only(
            'account_id', 'category_id', 'amount', 'date', 'description'
        ));

        return redirect()->route('transactions.index')->with('success', 'Transaction updated.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted.');
    }
}
