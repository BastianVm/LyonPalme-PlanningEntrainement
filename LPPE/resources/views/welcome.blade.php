<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LyonPalme - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(90deg, #00b4d8 0%, #00b4d8 20%, #6f2da8 100%);
            min-height: 100vh;
        }
        .marine-card {
            background: rgba(255,255,255,0.85);
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }
        .btn-marine {
            background-color: #0077b6;
            color: #fff;
            border: none;
        }
        .btn-marine:hover {
            background-color: #023e8a;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container py-5 d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="marine-card p-5 text-center w-100" style="max-width: 480px;">
            <x-application-logo style="width:400px; height:auto; margin-bottom: 1rem;" />
            <h1 class="mb-3" style="color: #0077b6; font-weight: bold;">Bienvenue sur LyonPalme</h1>
            <p class="mb-4" style="color: #023e8a;">
                Le site officiel du club de plongée et d’activités subaquatiques.<br>
                Retrouvez toutes les informations sur les entraînements, événements et la vie du club.
            </p>
            <div class="d-flex justify-content-center gap-2">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-marine btn-lg">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-marine btn-lg">Se connecter</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">S’inscrire</a>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>