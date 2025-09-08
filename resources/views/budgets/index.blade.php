@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Budgets</h2>
    <a href="{{ route('budgets.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm rounded-lg shadow hover:bg-primary/90">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Add Budget
    </a>
  </div>

  <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
    @forelse ($budgets as $budget)
      <div class="bg-white shadow rounded-lg p-4">
        <h3 class="text-sm font-semibold mb-2">{{ $budget->category->name }}</h3>
        <p class="text-xs text-gray-500 mb-2">Period: {{ $budget->start_date }} – {{ $budget->end_date }}</p>
        <div class="w-full bg-gray-100 rounded-full h-2 mb-2">
          <div class="h-2 bg-primary rounded-full" style="width: {{ $budget->spentPercent() }}%"></div>
        </div>
        <p class="text-sm">{{ $budget->spent() }} / {{ $budget->amount }}</p>
      </div>
    @empty
      <p class="text-gray-500 text-sm">No budgets set.</p>
    @endforelse
  </div>
</div>
@endsection
