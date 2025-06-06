<!-- resources/views/layouts/app.blade.php -->
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

        <style>
        :root {
            --violet-club: #6f2da8;
            --turquoise-club: #00b4d8;
            --vert-eau: #2ed9c3;
            --gris-fond: #f6fafd;
        }
        body {
            background: #f6fafd;
            min-height: 100vh;
            font-family: 'Figtree', 'Segoe UI', Arial, sans-serif;
        }
        .navbar, nav.bg-white {
            background: #fff !important;
            border-bottom: 2px solid var(--turquoise-club);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }
        .navbar .nav-link.active, .navbar .nav-link:focus {
            color: var(--violet-club) !important;
            border-bottom: 2px solid var(--violet-club);
        }
        .navbar .nav-link, nav .nav-link {
            color: #222 !important;
            font-weight: 500;
            margin: 0 1rem;
            transition: color 0.2s;
        }
        .navbar .nav-link:hover, nav .nav-link:hover {
            color: var(--turquoise-club) !important;
        }
        .table-container {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 24px 0 rgba(31, 38, 135, 0.07);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th {
            color: var(--violet-club);
            font-weight: bold;
            background: #f3f0fa;
            border-bottom: 2px solid var(--turquoise-club);
            padding: 10px;
        }
        .table td {
            color: #222;
            background: #fff;
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        .btn-primary {
            background: var(--turquoise-club);
            border: none;
            color: #fff;
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn-primary:hover {
            background: var(--violet-club);
            color: #fff;
        }
        .btn-success {
            background: var(--vert-eau);
            border: none;
            color: #fff;
            font-weight: 600;
        }
        .btn-warning {
            background: var(--violet-club);
            border: none;
            color: #fff;
            font-weight: 600;
        }
        h1, h2, h3, h4 {
            color: var(--violet-club);
            font-weight: bold;
        }
        .action-buttons .btn {
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>