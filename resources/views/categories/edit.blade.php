@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-semibold">Edit Category</h2>
    <a href="{{ route('categories.index') }}" class="text-sm text-gray-600 hover:underline">Back to categories</a>
  </div>

  <div class="bg-white shadow rounded-lg p-6">
    <form method="POST" action="{{ route('categories.update', $category) }}">
      @csrf @method('PATCH')
      <label class="block text-sm font-medium text-gray-700">Name</label>
      <input name="name" value="{{ old('name', $category->name) }}" class="mt-1 block w-full border rounded px-3 py-2 text-sm" required>

      <div class="mt-6 flex items-center gap-3">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm rounded-lg">Save</button>
        <a href="{{ route('categories.index') }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
