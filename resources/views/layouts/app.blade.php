<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ config('app.name', 'WalletWise') }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: { primary: '#0EA5A4' },
          fontFamily: { sans: ['Montserrat', 'ui-sans-serif', 'system-ui'] }
        }
      }
    }
  </script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
  @include('partials.header')

  <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
    @yield('content')
  </main>

  @include('partials.footer')
</body>
</html>