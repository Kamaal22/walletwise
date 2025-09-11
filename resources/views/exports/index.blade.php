@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">My Exports</h1>
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul class="divide-y divide-gray-200">
            @forelse($exports as $exp)
            <li class="px-4 py-4 flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-gray-900">Export #{{ $exp->id }} <span class="text-xs text-gray-500">({{ $exp->format }})</span></div>
                    <div class="text-sm text-gray-500">Created: {{ $exp->created_at->toDayDateTimeString() }}</div>
                    <div class="text-sm text-gray-500">Status: {{ $exp->status }} @if($exp->completed_at) — Completed: {{ $exp->completed_at->toDayDateTimeString() }}@endif</div>
                </div>
                <div class="flex items-center space-x-2">
                    @if($exp->status === 'done' && $exp->filename)
                        <a href="{{ route('exports.download', $exp) }}" class="px-3 py-1 bg-blue-600 text-white rounded">Download</a>
                    @elseif($exp->status === 'processing')
                        <span class="px-3 py-1 bg-yellow-200 text-yellow-800 rounded">Processing</span>
                    @else
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded">{{ ucfirst($exp->status) }}</span>
                    @endif
                </div>
            </li>
            @empty
            <li class="px-4 py-4">No exports yet.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
