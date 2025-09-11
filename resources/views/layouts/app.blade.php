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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" integrity="sha512-XcIsjKMcuVe0Ucj/xgIXQnytNwBttJbNjltBV18IOnru2lDPe9KRRyvCXw6Y5H415vbBLRm8+q6fmLUU7DfO6Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#0EA5A4'
          },
          fontFamily: {
            sans: ['Montserrat', 'ui-sans-serif', 'system-ui']
          }
        }
      }
    }
  </script>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
  @include('partials.header')

  @if (session('success'))
  <div data-dismissible class="mb-4 text-primary text-sm bg-primary/10 p-2 rounded relative" role="status">
    <span class="block text-center">{{ session('success') }}</span>
    <button type="button" class="absolute top-1.5 right-2 text-primary hover:text-green-900 p-1" aria-label="Dismiss"
      onclick="(function(el){ el.style.transition='opacity .2s'; el.style.opacity=0; setTimeout(()=>el.remove(),200); })(this.closest('[data-dismissible]'))">
      <i class="ri-close-line"></i>
    </button>
  </div>
  @endif
  @if ($errors->any())
  <div class="mb-4 text-red-600 text-sm text-center bg-red-50 p-2">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
    @yield('content')
  </main>

  @include('partials.footer')
</body>

</html>