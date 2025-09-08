@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
  <h2 class="text-2xl font-semibold mb-6">Reports</h2>

  <form method="GET" class="mb-6 flex gap-4">
    <input type="date" name="from" value="{{ $from->toDateString() }}" class="border rounded px-2 py-1">
    <input type="date" name="to" value="{{ $to->toDateString() }}" class="border rounded px-2 py-1">
    <button type="submit" class="px-4 py-2 bg-primary text-white rounded">Filter</button>
  </form>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-4 shadow rounded">
      <h3 class="text-sm text-gray-600 mb-2">Summary</h3>
      <p class="text-green-600">Income: {{ $income }}</p>
      <p class="text-red-600">Expenses: {{ $expenses }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
      <h3 class="text-sm text-gray-600 mb-2">By Category</h3>
      <ul class="text-sm">
        @foreach ($byCategory as $category => $total)
          <li>{{ $category }}: {{ $total }}</li>
        @endforeach
      </ul>
    </div>
  </div>

  <div class="bg-white shadow rounded overflow-hidden">
    <table class="min-w-full text-sm">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2">Date</th>
          <th class="px-4 py-2">Category</th>
          <th class="px-4 py-2">Amount</th>
        </tr>
      </thead>
      <tbody class="divide-y">
        @foreach ($transactions as $txn)
          <tr>
            <td class="px-4 py-2">{{ $txn->date->format('d M Y') }}</td>
            <td class="px-4 py-2">{{ $txn->category->name }}</td>
            <td class="px-4 py-2 {{ $txn->amount < 0 ? 'text-red-600' : 'text-green-600' }}">
              {{ $txn->amount }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
