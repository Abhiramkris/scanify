<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @isset($slot)
                {{ $slot }}
            @endisset
            @yield('content')
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>
<script>
    // Function to toggle dark mode
    function toggleDarkMode() {
        // Toggle dark class on the html element
        document.documentElement.classList.toggle('dark');

        // Save preference to localStorage
        localStorage.setItem('dark-mode',
            document.documentElement.classList.contains('dark'));
    }

    // Check for saved preference on page load
    if (localStorage.getItem('dark-mode') === 'true') {
        document.documentElement.classList.add('dark');
    }
</script>

</html>