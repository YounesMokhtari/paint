<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/landing.css'])

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased" dir="{{ app()->getLocale() === 'fa' ? 'rtl' : 'ltr' }}">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        {{-- @includeIf(auth()->id(), 'layouts.navigation') --}}
        @includeIf('layouts.navigation')
        @if (session('success'))
            <x-alert type="success" title="{{ session('success') }}">
            </x-alert>
        @endif
        @if (session('error'))
            <x-alert type="error" title="{{ session('error') }}">
            </x-alert>
        @endif
        @foreach ($errors->all() as $error)
            <x-alert type="error" title="{{ $error }}">
            </x-alert>
        @endforeach

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset


        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @stack('scripts')
</body>

</html>
