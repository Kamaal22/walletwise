@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
  <h2 class="text-2xl font-semibold mb-4">Export Data (Mock)</h2>

  <div class="bg-white shadow rounded-lg p-6">
    <p class="text-sm text-gray-600 mb-4">This is a mock export page showcasing export options. Export functionality is a placeholder.</p>

    <div class="grid gap-4">
      <div class="p-4 border rounded">
        <h3 class="font-semibold">Export selected transactions</h3>
        <p class="text-sm text-gray-500">Choose format and options, then click export (no real export yet).</p>
        <div class="mt-3 flex gap-2 items-center">
          <select class="border rounded px-3 py-2 text-sm">
            <option>CSV</option>
            <option>XLSX</option>
            <option>JSON</option>
          </select>
          <button class="px-3 py-2 bg-primary text-white rounded text-sm">Export (mock)</button>
        </div>
      </div>

      <div class="p-4 border rounded">
        <h3 class="font-semibold">Schedule export</h3>
        <p class="text-sm text-gray-500">Create scheduled exports (mock).</p>
      </div>

      <div class="p-4 border rounded">
        <h3 class="font-semibold">Export examples</h3>
        <pre class="text-xs bg-gray-100 p-2 rounded">[ { id: 1, date: '2025-09-08', amount: 12.34 }, ... ]</pre>
      </div>
    </div>
  </div>
</div>
@endsection
