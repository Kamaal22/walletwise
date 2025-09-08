@extends('layouts.app')

@section('content')
<main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Left column / Sidebar -->
        <aside class="lg:col-span-3">
            <!-- Accounts -->
            <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
                <h2 class="text-sm font-medium text-gray-700 mb-4">Accounts</h2>
                <ul class="space-y-3">
                    @foreach($user->accounts as $account)
                        <li class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold">{{ $account->name }}</p>
                                <p class="text-xs text-gray-500">{{ strtoupper($account->currency) }} • •••• {{ $account->last_digits }}</p>
                            </div>
                            <div class="text-sm font-medium">
                                {{ $account->balance >= 0 ? '$'.$account->balance : '-$'.abs($account->balance) }}
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-6 flex gap-2">
                    <button class="flex-1 bg-primary text-white py-2 rounded-lg text-sm font-medium shadow">Add Account</button>
                    <button class="flex-1 border border-gray-200 py-2 rounded-lg text-sm">Quick Add Txn</button>
                </div>
            </div>

            <!-- Budgets -->
            <div class="mt-6 bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Budgets</h3>
                <div class="space-y-3">
                    @foreach($user->budgets as $budget)
                        <div>
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>{{ $budget->name }}</span>
                                <span>${{ $budget->spent() }} / ${{ $budget->amount }}</span>
                            </div>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-2 rounded-full" style="width:{{ $budget->amount > 0 ? round(($budget->spent()/ $budget->amount)*100) : 0 }}%; background: linear-gradient(90deg,var(--tw-gradient-stops)); --tw-gradient-from:#0ea5a4; --tw-gradient-to:#34d399"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-6 p-4 text-xs text-gray-500">Offline-first, PWA-ready layout. Clean minimal UI for fast data entry.</div>
        </aside>

        <!-- Main content -->
        <section class="lg:col-span-9 space-y-6">
            <!-- Summary cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
                    <p class="text-xs text-gray-500">Total Balance</p>
                    <p class="text-2xl font-semibold mt-1">${{ $summary['income'] - $summary['expenses'] }}</p>
                </div>
                <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
                    <p class="text-xs text-gray-500">This Month — Income</p>
                    <p class="text-2xl font-semibold mt-1">${{ $summary['income'] }}</p>
                </div>
                <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
                    <p class="text-xs text-gray-500">This Month — Expenses</p>
                    <p class="text-2xl font-semibold text-red-600 mt-1">${{ $summary['expenses'] }}</p>
                </div>
            </div>

            <!-- Charts + Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <!-- Expenses Chart -->
                <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
                    <div class="flex items-start justify-between">
                        <h4 class="text-sm font-medium text-gray-700">Expenses — Monthly</h4>
                        <select class="text-sm text-gray-500 bg-transparent">
                            <option>Last 6 months</option>
                            <option>Year</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <canvas id="expensesChart" class="w-full h-32"></canvas>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
                    <div class="flex items-start justify-between">
                        <h4 class="text-sm font-medium text-gray-700">Recent Transactions</h4>
                        <a href="{{ route('transactions.index') }}" class="text-xs border border-gray-200 px-2 py-1 rounded">View all</a>
                    </div>
                    <ul class="mt-4 divide-y divide-gray-100">
                        @foreach($recentTransactions as $txn)
                            <li class="py-3 flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium">{{ $txn->category->name ?? 'N/A' }} — {{ $txn->description }}</p>
                                    <p class="text-xs text-gray-500">{{ $txn->category->type ?? 'Expense' }} • {{ $txn->date->format('d M') }}</p>
                                </div>
                                <div class="text-sm {{ $txn->amount > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $txn->amount > 0 ? '+$'.$txn->amount : '-$'.abs($txn->amount) }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Personal Insight -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2 bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
                    <h4 class="text-sm font-medium text-gray-700">Personal Insight</h4>
                    <p class="text-sm text-gray-600 mt-2">
                        You spent <span class="font-semibold">{{ round($summary['expenses']/($summary['income']?:1)*100) }}%</span> of your income this month. Consider setting a weekly limit.
                    </p>
                    <div class="mt-4 flex gap-2">
                        <button class="px-3 py-2 rounded-lg bg-primary text-white text-sm">Create Budget</button>
                        <a href="{{ route('reports.index') }}" class="px-3 py-2 rounded-lg border border-gray-200 text-sm inline-block">View Report</a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
                    <h4 class="text-sm font-medium text-gray-700">Quick Reports</h4>
                    <ul class="mt-3 text-sm text-gray-600 space-y-2">
                        <li>Export CSV — Month</li>
                        <li>Export PDF — Custom Range</li>
                        <li>Email Summary — Weekly</li>
                    </ul>
                </div>
            </div>

            <!-- Footer CTA -->
            <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm text-center">
                <p class="text-sm text-gray-600">WalletWise PWA: fast, responsive, mobile-first. Manage your finances efficiently.</p>
            </div>
        </section>
    </div>
</main>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('expensesChart').getContext('2d');
const data = {
    labels: {!! json_encode($user->transactions()->latest('date')->take(6)->pluck('date')->map(fn($d)=>$d->format('M')) ) !!},
    datasets: [{
        label: 'Expenses',
        data: {!! json_encode($user->transactions()->where('amount','<',0)->latest('date')->take(6)->pluck('amount')->map(fn($v)=>abs($v))) !!},
        backgroundColor: '#0ea5a4'
    }]
};
new Chart(ctx, { type: 'bar', data });
</script>
@endpush
@endsection
