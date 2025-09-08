@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Transactions</h2>
    <a href="{{ route('transactions.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm rounded-lg shadow hover:bg-primary/90">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Add Transaction
    </a>
  </div>

  <div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full text-sm">
      <thead class="bg-gray-50 text-left">
        <tr>
          <th class="px-4 py-2">Date</th>
          <th class="px-4 py-2">Account</th>
          <th class="px-4 py-2">Category</th>
          <th class="px-4 py-2">Description</th>
          <th class="px-4 py-2">Amount</th>
          <th class="px-4 py-2"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse ($transactions as $txn)
          <tr>
            <td class="px-4 py-2">{{ $txn->date->format('d M Y') }}</td>
            <td class="px-4 py-2">{{ $txn->account->name }}</td>
            <td class="px-4 py-2">{{ $txn->category->name }}</td>
            <td class="px-4 py-2">{{ $txn->description ?? '-' }}</td>
            <td class="px-4 py-2 {{ $txn->amount < 0 ? 'text-red-600' : 'text-green-600' }}">
              {{ $txn->amount }}
            </td>
            <td class="px-4 py-2">
              <form method="POST" action="{{ route('transactions.destroy', $txn) }}">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="px-4 py-4 text-center text-gray-500">No transactions found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $transactions->links() }}
  </div>
</div>
@endsection
