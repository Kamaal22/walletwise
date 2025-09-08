@extends('layouts.app')

@section('content')
<section id="dashboard" class="max-w-7xl mx-auto p-6">
  <h2 class="text-2xl font-semibold mb-4">Dashboard</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <x-summary-card title="Total Income" :value="'$' . $summary['income']" />
    <x-summary-card title="Total Expenses" :value="'$' . $summary['expenses']" />
    <x-summary-card title="Budget Used" :value="$summary['budgetUsed'] . '%'" />
    <x-summary-card title="Accounts" :value="$summary['accounts'] . ' Active'" />
  </div>
</section>
@endsection
