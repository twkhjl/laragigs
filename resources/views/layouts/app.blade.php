<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>

  <script src="
    https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js
    "></script>
  <link href="
https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css
" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <script src="//unpkg.com/alpinejs" defer></script>

  <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
  <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
</head>

<body class="font-sans antialiased">
  <div class="min-h-screen min-w-screen bg-gray-100">
    @include('layouts.navigation')


    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>
  </div>

  @include('components.flash-success')
  @include('components.flash-danger')

  @include('components.footer')

</body>

</html>
