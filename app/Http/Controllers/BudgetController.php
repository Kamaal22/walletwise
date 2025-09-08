<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::with('category')->get();
        return view('budgets.index', compact('budgets'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('budgets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount'      => 'required|numeric|min:0',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
        ]);

        Budget::create($request->only('category_id', 'amount', 'start_date', 'end_date'));

        return redirect()->route('budgets.index')->with('success', 'Budget created.');
    }
}
