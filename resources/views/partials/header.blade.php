<header class="w-full bg-white border-b border-gray-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center gap-4">
        <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center text-white font-bold">W</div>
        <div>
          <h1 class="text-lg font-semibold">WalletWise</h1>
          <p class="text-xs text-gray-500">Personal Expense Tracker</p>
        </div>
      </div>
      <div class="flex items-center gap-4">
        <nav class="hidden md:flex gap-4 text-sm text-gray-600">
          <a href="{{ route('dashboard') }}" class="hover:text-gray-900">Dashboard</a>
          <a href="{{ route('accounts') }}" class="hover:text-gray-900">Accounts</a>
          <a href="{{ route('transactions') }}" class="hover:text-gray-900">Transactions</a>
          <a href="{{ route('budgets') }}" class="hover:text-gray-900">Budgets</a>
          <a href="{{ route('reports') }}" class="hover:text-gray-900">Reports</a>
        </nav>
        <button class="bg-white border border-gray-200 px-3 py-2 rounded-lg text-sm shadow-sm">Export</button>
        <div class="flex items-center gap-3">
          <button class="text-sm text-gray-600">🔔</button>
          <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center text-sm">VV</div>
        </div>
      </div>
    </div>
  </div>
</header>