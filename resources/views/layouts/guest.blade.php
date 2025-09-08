<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WalletWise - Auth</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.34.1/tabler-icons.min.css" integrity="sha512-s0zOeW/zxh8f817uykbgBqmx1dwmdvWwQYamh+lU9NzP8jeQ/ikNPE9dBK+C55A5WUtOetZAI09tLxKIj0r9WQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script>
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

<body class="antialiased bg-gray-50">
  @yield('content')
</body>

</html>