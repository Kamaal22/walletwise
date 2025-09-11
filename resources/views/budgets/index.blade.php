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
  <form method="GET" class="mb-4 flex gap-2 items-center">
    <select name="category" class="border rounded px-3 py-2 text-sm">
      <option value="">All categories</option>
      @foreach(\App\Models\Category::all() as $cat)
        <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
      @endforeach
    </select>
    <select name="sort" class="border rounded px-3 py-2 text-sm">
      <option value="start_date" @selected(request('sort')=='start_date')>Start date</option>
      <option value="amount" @selected(request('sort')=='amount')>Amount</option>
    </select>
    <select name="dir" class="border rounded px-3 py-2 text-sm">
      <option value="asc" @selected(request('dir')=='asc')>Asc</option>
      <option value="desc" @selected(request('dir')=='desc')>Desc</option>
    </select>
    <button class="px-3 py-2 bg-primary text-white rounded text-sm">Filter</button>
  </form>

  <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
    @forelse ($budgets as $budget)
      <div class="bg-white shadow rounded-lg p-4">
        <div class="flex justify-between items-start">
          <div>
            <h3 class="text-sm font-semibold mb-2">{{ $budget->category->name }}</h3>
            <p class="text-xs text-gray-500 mb-2">
              Period: {{ \Carbon\Carbon::parse($budget->start_date)->format('d-M-Y') }} – {{ \Carbon\Carbon::parse($budget->end_date)->format('d-M-Y') }}
            </p></p>
            <div class="w-full bg-gray-100 rounded-full h-2 mb-2">
              @php
                $pct = $budget->spentPercent();
                $isOver = $budget->spent() > $budget->amount;
                $width = $pct > 100 ? 100 : $pct;
              @endphp
              <div class="h-2 rounded-full {{ $isOver ? 'bg-red-500' : 'bg-primary' }}" style="width: {{ $width }}%"></div>
            </div>
            <p class="text-sm">{{ $budget->spent() }} / {{ $budget->amount }}</p>
          </div>
          <div class="flex flex-col gap-2">
            <a href="{{ route('budgets.edit', $budget) }}" class="text-gray-600 hover:text-primary" title="Edit"><i class="p-2 bg-primary/10 rounded text-primary ri-edit-box-line text-lg"></i></a>
            <button type="button" data-delete-message="Are you sure you want to delete budget for {{ $budget->category->name }}" data-delete-action="{{ route('budgets.destroy', $budget) }}" class="text-red-600 hover:text-red-800 js-delete-btn" title="Delete"><i class="p-2 bg-red-50 rounded ri-delete-bin-line text-lg"></i></button>
          </div>
        </div>
      </div>
    @empty
      <p class="text-gray-500 text-sm">No budgets set.</p>
    @endforelse
  </div>

  @include('partials.confirm-modal')

  <script>
    document.querySelectorAll('.js-delete-btn').forEach(function(btn){
      btn.addEventListener('click', function(){
        showConfirmModal(this.dataset.deleteMessage, this.dataset.deleteAction);
      });
    });
  </script>
</div>
@endsection
