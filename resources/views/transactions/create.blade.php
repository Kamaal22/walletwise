@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-semibold">Add Transaction</h2>
    <a href="{{ route('transactions.index') }}" class="text-sm text-gray-600 hover:underline">Back to transactions</a>
  </div>

  <div class="bg-white shadow rounded-lg p-6">
    <form method="POST" action="{{ route('transactions.store') }}">
      @csrf

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Date</label>
          <input type="date" name="date" value="{{ old('date', now()->toDateString()) }}" class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Account</label>
          <select name="account_id" class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" required>
            <option value="">Select account</option>
            @foreach($accounts as $account)
              <option value="{{ $account->id }}" @selected(old('account_id') == $account->id)>{{ $account->name }} — {{ $account->currency ?? '' }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Category</label>
          <select name="category_id" class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" required>
            <option value="">Select category</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Amount</label>

          <div class="mt-1 flex">
            <button
              type="button"
              id="sign-toggle"
              aria-pressed="{{ old('sign', '-') === '-' ? 'true' : 'false' }}"
              class="inline-flex items-center px-3 py-2 border border-r-0 rounded-l-md text-sm focus:outline-none
                 {{ old('sign', '-') === '-' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
              {{ old('sign', '-') === '-' ? '-' : '+' }}
            </button>

            <input
              type="number"
              step="0.01"
              name="amount"
              value="{{ old('amount') }}"
              class="flex-1 block w-full border rounded-r-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary"
              required
            >

            <input type="hidden" name="sign" id="sign-input" value="{{ old('sign', '-') }}">
          </div>

          <script>
            (function () {
              var btn = document.getElementById('sign-toggle');
              var hidden = document.getElementById('sign-input');

              if (!btn || !hidden) return;

              function applyStyles() {
            if (hidden.value === '-') {
              btn.textContent = '-';
              btn.classList.remove('bg-green-100','text-green-600');
              btn.classList.add('bg-red-100','text-red-600');
              btn.setAttribute('aria-pressed','true');
            } else {
              btn.textContent = '+';
              btn.classList.remove('bg-red-100','text-red-600');
              btn.classList.add('bg-green-100','text-green-600');
              btn.setAttribute('aria-pressed','false');
            }
              }

              btn.addEventListener('click', function () {
            hidden.value = hidden.value === '-' ? '+' : '-';
            applyStyles();
              });

              // initialize
              applyStyles();
            })();
          </script>
        </div>
      </div>

      <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">Description (optional)</label>
        <input type="text" name="description" value="{{ old('description') }}" class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" placeholder="e.g. Grocery shopping">
      </div>

      <div class="mt-6 flex items-center gap-3">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm rounded-lg shadow hover:bg-primary/90">Save transaction</button>
        <a href="{{ route('transactions.index') }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
