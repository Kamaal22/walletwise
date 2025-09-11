<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
    $query = auth()->user()->accounts()->withCount('transactions');

    // Sorting
    $sort = request('sort', 'name');
    $dir = request('dir', 'asc');
    if (!in_array($sort, ['name', 'balance', 'transactions_count'])) $sort = 'name';
    if (!in_array($dir, ['asc', 'desc'])) $dir = 'asc';

    $accounts = $query->orderBy($sort, $dir)->get();

    return view('accounts.index', compact('accounts', 'sort', 'dir'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'balance' => 'required|numeric',
        ]);

        auth()->user()->accounts()->create($request->only('name', 'balance'));

        return redirect()->route('accounts.index')->with('success', 'Account created.');
    }

    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {

        $request->validate([
            'name'    => 'required|string|max:255',
            'balance' => 'required|numeric',
        ]);

        $account->update($request->only('name', 'balance'));

        return redirect()->route('accounts.index')->with('success', 'Account updated.');
    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'Account deleted.');
    }
}


