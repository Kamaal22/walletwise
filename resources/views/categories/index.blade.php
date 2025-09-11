@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Categories</h2>
    <a href="{{ route('categories.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm rounded-lg shadow hover:bg-primary/90">Add Category</a>
  </div>

  <form method="GET" class="mb-4 flex gap-2 items-center overflow-scroll">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search categories" class="border rounded px-3 py-2 text-sm" />
    <select name="sort" class="border rounded px-3 py-2 text-sm">
      <option value="name" @selected(request('sort')=='name')>Name</option>
      <option value="created_at" @selected(request('sort')=='created_at')>Created</option>
    </select>
    <select name="dir" class="border rounded px-3 py-2 text-sm">
      <option value="asc" @selected(request('dir')=='asc')>Asc</option>
      <option value="desc" @selected(request('dir')=='desc')>Desc</option>
    </select>
    <button class="px-3 py-2 bg-primary text-white rounded text-sm">Filter</button>
  </form>

  <div class="bg-white shadow rounded-lg divide-y divide-gray-100">
    @forelse ($categories as $category)
      <div class="p-4 flex justify-between items-center">
        <div>
          <p class="text-sm font-semibold">{{ $category->name }}</p>
        </div>
          <div class="flex gap-2">
            <a href="{{ route('categories.edit', $category) }}" class="text-gray-600 hover:text-primary" title="Edit"><i class="p-2 bg-primary/10 rounded text-primary ri-edit-box-line text-lg"></i></a>
            <button type="button" data-delete-message="Are you sure you want to delete category: {{ $category->name }}" data-delete-action="{{ route('categories.destroy', $category) }}" class="text-red-600 hover:text-red-800 js-delete-btn" title="Delete"><i class="p-2 bg-red-50 rounded ri-delete-bin-line text-lg"></i></button>
          </div>
      </div>
    @empty
      <p class="p-4 text-gray-500 text-sm">No categories yet.</p>
    @endforelse
  </div>

  @include('partials.confirm-modal')
</div>
</div>

<script>
  document.querySelectorAll('.js-delete-btn').forEach(function(btn){
    btn.addEventListener('click', function(){
      showConfirmModal(this.dataset.deleteMessage, this.dataset.deleteAction);
    });
  });
</script>
@endsection
