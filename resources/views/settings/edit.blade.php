@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
  <h2 class="text-2xl font-semibold mb-4">Settings</h2>

  <div class="bg-white shadow rounded-lg p-6">
    <form method="POST" action="{{ route('settings.update') }}">
      @csrf

      <div class="grid grid-cols-1 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Name</label>
          <input name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border rounded px-3 py-2 text-sm" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border rounded px-3 py-2 text-sm" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Primary Color</label>
          <div class="flex gap-2 mt-2">
            @foreach($colors as $color)
              <label style="background: {{ $color }}" class="w-8 h-8 rounded cursor-pointer border-2" title="{{ $color }}">
                <input type="radio" name="preferences[primary_color]" value="{{ $color }}" @checked(old('preferences.primary_color', $user->getPreference('primary_color')) == $color) class="hidden">
              </label>
            @endforeach
          </div>
        </div>

        <div>
          <label class="flex items-center gap-2">
            <input type="hidden" name="preferences[dark_mode]" value="0">
            <input type="checkbox" name="preferences[dark_mode]" value="1" @checked($user->getPreference('dark_mode')) class="rounded"> Dark mode
          </label>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Language</label>
          <select name="preferences[language]" class="mt-1 block w-full border rounded px-3 py-2 text-sm">
            <option value="en" @selected($user->getPreference('language','en')=='en')>English</option>
            <option value="so" @selected($user->getPreference('language')=='so')>Somali</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Export Preferences (mock)</label>
          <div class="mt-2 text-sm text-gray-600">Choose default export format:</div>
          <select name="preferences[export][format]" class="mt-1 block w-48 border rounded px-3 py-2 text-sm">
            <option value="csv" @selected($user->getPreference('export.format')=='csv')>CSV</option>
            <option value="xlsx" @selected($user->getPreference('export.format')=='xlsx')>XLSX</option>
            <option value="json" @selected($user->getPreference('export.format')=='json')>JSON</option>
          </select>
        </div>
      </div>

      <div class="mt-6 flex items-center gap-3">
        <button type="submit" class="px-4 py-2 bg-primary text-white rounded">Save settings</button>
  <a href="{{ route('export.index') }}" class="px-4 py-2 border rounded text-sm">Export Data (mock)</a>
      </div>
    </form>
  </div>
</div>
<script>
  // instant preview for primary color and dark mode
  document.querySelectorAll('input[name="preferences[primary_color]"]').forEach(function(r){
    r.addEventListener('change', function(){
      document.body.style.setProperty('--primary', this.value);
    });
  });
  var dm = document.querySelector('input[name="preferences[dark_mode]"]');
  if (dm) dm.addEventListener('change', function(){
    if (this.checked) document.body.classList.add('dark'); else document.body.classList.remove('dark');
  });
</script>
@endsection
