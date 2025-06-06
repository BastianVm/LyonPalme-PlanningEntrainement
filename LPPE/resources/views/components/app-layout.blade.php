{{-- resources/views/components/app-layout.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
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
        .table-container {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 24px 0 rgba(31, 38, 135, 0.07);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
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
        h1, h2, h3, h4 {
            color: var(--violet-club);
            font-weight: bold;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')

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
            {{ $slot }}
        </main>
    </div>
</body>
</html>