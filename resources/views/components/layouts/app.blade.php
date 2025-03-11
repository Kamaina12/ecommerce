<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Custom CSS -->
    <link href="assets/css/theme.css" rel="stylesheet" />
    
    <!-- Tailwind -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <title>{{ $title ?? 'Market-cart' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-200 dark:bg-slate-700">

    @include('Pages.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('Pages.partials.footer')
    @livewireStyles
    @livewireScripts
    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
