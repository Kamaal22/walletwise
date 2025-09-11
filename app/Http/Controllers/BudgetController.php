<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        $query = Budget::with('category');

        if (request()->filled('category')) {
            $query->where('category_id', request('category'));
        }

        $sort = request('sort', 'start_date');
        $dir = request('dir', 'asc');
        if (!in_array($sort, ['start_date', 'amount'])) $sort = 'start_date';
        if (!in_array($dir, ['asc', 'desc'])) $dir = 'asc';

        $budgets = $query->orderBy($sort, $dir)->get();
        return view('budgets.index', compact('budgets', 'sort', 'dir'));
    }

    public function create()
    {
        $categories = Category::get();
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
        
        Budget::create(array_merge(
            $request->only('category_id', 'amount', 'start_date', 'end_date'),
            ['user_id' => auth()->id()]
        ));

        return redirect()->route('budgets.index')->with('success', 'Budget created.');
    }

    public function edit(Budget $budget)
    {
        return view('budgets.edit', compact('budget'));
    }

    public function update(Request $request, Budget $budget)
    {

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount'      => 'required|numeric|min:0',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
        ]);


        $budget->update($request->only('category_id', 'amount', 'start_date', 'end_date'));

        return redirect()->route('budgets.index')->with('success', 'Budget updated.');
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();

        return redirect()->route('budgets.index')->with('success', 'Budget deleted.');
    }
}
