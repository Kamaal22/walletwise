<header class="w-full bg-white border-b border-gray-200 dark:bg-gray-900 dark:border-gray-700 top-0 left-0 right-0 z-30" style="--primary-color: theme('colors.primary.500')">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">

      <!-- Logo + Title -->
      <div class="flex items-center gap-4">
        <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center text-white font-bold">W</div>
        <div>
          <h1 class="text-lg font-semibold text-gray-900 dark:text-white">WalletWise</h1>
          <p class="text-xs text-gray-500 dark:text-gray-400">Personal Expense Tracker</p>
        </div>
      </div>

      <!-- Mobile: dark mode + hamburger -->
      <div class="md:hidden flex items-center gap-4">
        <button id="darkModeToggle" aria-label="Toggle Dark Mode" class="text-gray-600 dark:text-gray-300 text-xl">
          <i class="ri-moon-line"></i>
        </button>

        <button id="mobileMenuBtn" aria-label="Open Menu" class="text-gray-600 dark:text-gray-300 text-3xl">
          <i class="ri-menu-line"></i>
        </button>
      </div>

      <!-- Desktop nav + export + user -->
      <div class="hidden md:flex items-center gap-4">
        <nav class="flex gap-6 text-sm text-gray-600 dark:text-gray-300">
          @php
          $initials = 'U';
          if ($user = auth()->user()) {
          $parts = preg_split('/\s+/', trim($user->name ?? ''));
          if (count($parts) >= 2) {
          $initials = strtoupper($parts[0][0] . $parts[1][0]);
          } elseif (count($parts) === 1) {
          $initials = strtoupper(substr($parts[0], 0, 2));
          }
          }
          function isActiveRoute($routeName) {
          return request()->routeIs($routeName) ? 'text-primary font-semibold border-b-2 border-primary' : 'hover:text-gray-900 dark:hover:text-white';
          }
          @endphp

          <a href="{{ route('dashboard') }}" class="{{ isActiveRoute('dashboard') }}">Dashboard</a>
          <a href="{{ route('accounts.index') }}" class="{{ isActiveRoute('accounts.index') }}">Accounts</a>
          <a href="{{ route('transactions.index') }}" class="{{ isActiveRoute('transactions.index') }}">Transactions</a>
          <a href="{{ route('categories.index') }}" class="{{ isActiveRoute('categories.index') }}">Categories</a>
          <a href="{{ route('budgets.index') }}" class="{{ isActiveRoute('budgets.index') }}">Budgets</a>
          <a href="{{ route('reports.index') }}" class="{{ isActiveRoute('reports.index') }}">Reports</a>
        </nav>

        <button class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 px-3 py-2 rounded-lg text-sm shadow-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          Export
        </button>

        <!-- Profile dropdown desktop -->
        <div class="relative" id="profileDropdownWrapper">
          <button id="profileDropdownBtn" class="w-9 h-9 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-sm text-gray-700 dark:text-gray-200 font-semibold select-none focus:outline-none">
            {{ $initials }}
          </button>
          <div id="profileDropdownMenu" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-2 z-50 border border-gray-200 dark:border-gray-700 hidden">
            <a href="{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Profile</a>
            <a href="{ route('settings.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Settings</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Side drawer mobile menu -->
  <div id="mobileDrawer" class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 transform -translate-x-full transition-transform duration-300 ease-in-out z-40 shadow-lg">
    <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
      <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Menu</h2>
      <button id="mobileDrawerCloseBtn" aria-label="Close Menu" class="text-gray-600 dark:text-gray-300 text-3xl">
        <i class="ri-close-line"></i>
      </button>
    </div>
    <nav class="flex flex-col p-4 space-y-4 text-gray-700 dark:text-gray-300 text-sm">
      <a href="{{ route('dashboard') }}" class="{{ isActiveRoute('dashboard') }}">Dashboard</a>
      <a href="{{ route('accounts.index') }}" class="{{ isActiveRoute('accounts.index') }}">Accounts</a>
      <a href="{{ route('transactions.index') }}" class="{{ isActiveRoute('transactions.index') }}">Transactions</a>
      <a href="{{ route('categories.index') }}" class="{{ isActiveRoute('categories.index') }}">Categories</a>
      <a href="{{ route('budgets.index') }}" class="{{ isActiveRoute('budgets.index') }}">Budgets</a>
      <a href="{{ route('reports.index') }}" class="{{ isActiveRoute('reports.index') }}">Reports</a>
      <button class="mt-4 bg-primary text-white px-3 py-2 rounded-lg text-center shadow-sm hover:bg-primary-dark transition">
        Export
      </button>

      <!-- Profile section mobile -->
      <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-4">
        <div class="flex items-center gap-3 mb-3">
          <div class="w-9 h-9 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-sm text-gray-700 dark:text-gray-200 font-semibold select-none">
            {{ $initials }}
          </div>
          <span class="text-gray-900 dark:text-white font-medium">{{ $user->name ?? 'User' }}</span>
        </div>
        <a href="{ route('profile.show') }}" class="block py-2 px-3 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Profile</a>
        <a href="{ route('settings.index') }}" class="block py-2 px-3 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Settings</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full text-left py-2 px-3 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Logout</button>
        </form>
      </div>
    </nav>
  </div>

  <!-- Overlay -->
  <div id="mobileOverlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-30"></div>

  <script>
    // AlpineJS is used here for dropdown; if not available, we fallback to vanilla JS
    // Desktop profile dropdown with AlpineJS or fallback:
    if (!window.Alpine) {
      document.querySelectorAll('[x-data]').forEach(el => {
        const button = el.querySelector('button');
        const menu = el.querySelector('div[x-show]');
        button.addEventListener('click', () => {
          if (menu.style.display === 'block') {
            menu.style.display = 'none';
          } else {
            menu.style.display = 'block';
          }
        });
        document.addEventListener('click', e => {
          if (!el.contains(e.target)) {
            menu.style.display = 'none';
          }
        });
      });
    }

    // Mobile drawer toggle
    const drawer = document.getElementById('mobileDrawer');
    const overlay = document.getElementById('mobileOverlay');
    const openBtn = document.getElementById('mobileMenuBtn');
    const closeBtn = document.getElementById('mobileDrawerCloseBtn');
    // Only enable mobile drawer on small screens (Tailwind 'md' = 768px)
    if (drawer && overlay && openBtn && closeBtn) {
      const mdQuery = window.matchMedia('(min-width: 768px)');

      const updateDrawerForViewport = () => {
        if (mdQuery.matches) {
          // On medium+ screens ensure drawer is hidden and disabled
          drawer.classList.add('-translate-x-full');
          overlay.classList.add('hidden');
          document.body.style.overflow = '';
          openBtn.setAttribute('aria-hidden', 'true');
          openBtn.disabled = true;
        } else {
          // On small screens enable the drawer button
          openBtn.removeAttribute('aria-hidden');
          openBtn.disabled = false;
        }
      };

      updateDrawerForViewport();

      if (typeof mdQuery.addEventListener === 'function') {
        mdQuery.addEventListener('change', updateDrawerForViewport);
      } else if (typeof mdQuery.addListener === 'function') {
        mdQuery.addListener(updateDrawerForViewport);
      }
    }
    openBtn.addEventListener('click', () => {
      drawer.classList.remove('-translate-x-full');
      overlay.classList.remove('hidden');
      document.body.style.overflow = 'hidden'; // Prevent background scroll
    });

    closeBtn.addEventListener('click', () => {
      drawer.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
      document.body.style.overflow = '';
    });

    overlay.addEventListener('click', () => {
      drawer.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
      document.body.style.overflow = '';
    });

    // Dark mode toggle
    const darkModeToggle = document.getElementById('darkModeToggle');
    const html = document.documentElement;
    const moonIcon = '<i class="ri-moon-line"></i>';
    const sunIcon = '<i class="ri-sun-line"></i>';

    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      html.classList.add('dark');
      darkModeToggle.innerHTML = sunIcon;
    } else {
      darkModeToggle.innerHTML = moonIcon;
    }

    darkModeToggle.addEventListener('click', () => {
      if (html.classList.contains('dark')) {
        html.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        darkModeToggle.innerHTML = moonIcon;
      } else {
        html.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        darkModeToggle.innerHTML = sunIcon;
      }
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const toggleBtn = document.getElementById('profileDropdownBtn');
      const dropdown = document.getElementById('profileDropdownMenu');

      // Toggle dropdown on button click
      toggleBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
      });

      // Hide dropdown if clicked outside
      document.addEventListener('click', function(e) {
        if (!document.getElementById('profileDropdownWrapper').contains(e.target)) {
          dropdown.classList.add('hidden');
        }
      });
    });
  </script>
</header>