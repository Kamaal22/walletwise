@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Accounts</h2>
    <a href="{{ route('accounts.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm rounded-lg shadow hover:bg-primary/90">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Add Account
    </a>
  </div>

  <div class="bg-white shadow rounded-lg divide-y divide-gray-100">
    @forelse ($accounts as $account)
      <div class="p-4 flex justify-between items-center">
        <div>
          <p class="text-sm font-semibold">{{ $account->name }}</p>
          <p class="text-xs text-gray-500">Balance: {{ $account->balance }}</p>
        </div>
        <div class="flex gap-2">
          <a href="{{ route('accounts.edit', $account) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
          <form method="POST" action="{{ route('accounts.destroy', $account) }}">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
          </form>
        </div>
      </div>
    @empty
      <p class="p-4 text-gray-500 text-sm">No accounts yet.</p>
    @endforelse
  </div>
</div>
@endsection
