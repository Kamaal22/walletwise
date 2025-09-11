@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-semibold">Add Budget</h2>
    <a href="{{ route('budgets.index') }}" class="text-sm text-gray-600 hover:underline">Back to budgets</a>
  </div>

  <div class="bg-white shadow rounded-lg p-6">
    <form method="POST" action="{{ route('budgets.store') }}">
      @csrf
      <label class="block text-sm font-medium text-gray-700">Category</label>
      <select name="category_id" class="mt-1 block w-full border rounded px-3 py-2 text-sm" required>
        <option value="">Select category</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
        @endforeach
      </select>

      <label class="block text-sm font-medium text-gray-700 mt-4">Amount</label>
      <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="mt-1 block w-full border rounded px-3 py-2 text-sm" required>

      <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Start date</label>
          <input type="date" name="start_date" value="{{ old('start_date') }}" class="mt-1 block w-full border rounded px-3 py-2 text-sm" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">End date</label>
          <input type="date" name="end_date" value="{{ old('end_date') }}" class="mt-1 block w-full border rounded px-3 py-2 text-sm" required>
        </div>
      </div>

      <div class="mt-6 flex items-center gap-3">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm rounded-lg">Save</button>
        <a href="{{ route('budgets.index') }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
