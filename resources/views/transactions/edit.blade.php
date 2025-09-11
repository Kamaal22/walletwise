@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-semibold">Edit Transaction</h2>
    <a href="{{ route('transactions.index') }}" class="text-sm text-gray-600 hover:underline">Back to transactions</a>
  </div>

  <div class="bg-white shadow rounded-lg p-6">
    <form method="POST" action="{{ route('transactions.update', $transaction) }}">
      @csrf
      @method('PATCH')

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Date</label>
          <input type="date" name="date" value="{{ old('date', $transaction->date->toDateString()) }}" class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Account</label>
          <select name="account_id" class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" required>
            <option value="">Select account</option>
            @foreach($accounts as $account)
              <option value="{{ $account->id }}" @selected(old('account_id', $transaction->account_id) == $account->id)>{{ $account->name }} — {{ $account->currency ?? '' }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Category</label>
          <select name="category_id" class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" required>
            <option value="">Select category</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" @selected(old('category_id', $transaction->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
          </select>
        </div>

        
        <div>
          <label class="block text-sm font-medium text-gray-700">Amount</label>
          <input type="number" step="0.01" name="amount" value="{{ old('amount', $transaction->amount) }}" class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" required>
        </div>
      </div>

      <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">Description (optional)</label>
        <input type="text" name="description" value="{{ old('description', $transaction->description) }}" class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" placeholder="e.g. Grocery shopping">
      </div>

      <div class="mt-6 flex items-center gap-3">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm rounded-lg shadow hover:bg-primary/90">Update transaction</button>
        <a href="{{ route('transactions.index') }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
