@extends('layouts.app')

@section('content')
    <div class="admin-dashboard-container">
        <div class="admin-header">
            <h1>Bienvenue sur le tableau de bord administrateur</h1>
            <p>
                Connecté en tant qu'<strong>administrateur</strong>
                <i class="fas fa-user-shield" style="color: #6f2da8; margin-left: 8px;"></i>
            </p>
        </div>
        <div class="admin-actions">
            <a href="{{ route('entrainements.index') }}" class="dashboard-card card-blue">
                <i class="fas fa-dumbbell"></i>
                <span>Gérer les entraînements</span>
            </a>
            <a href="{{ route('planning.index') }}" class="dashboard-card card-violet">
                <i class="fas fa-calendar-alt"></i>
                <span>Gérer les séances</span>
            </a>
            <a href="{{ route('admin.indisponibilites.index') }}" class="dashboard-card card-blue-light">
                <i class="fas fa-user-clock"></i>
                <span>Voir les indisponibilités</span>
            </a>
        </div>
    </div>
    <style>
        .admin-dashboard-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 32px 24px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 6px 32px rgba(111,45,168,0.08), 0 1.5px 6px rgba(0,0,0,0.04);
        }
        .admin-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .admin-header h1 {
            font-size: 2.1em;
            color: #6f2da8;
            margin-bottom: 10px;
        }
        .admin-header p {
            font-size: 1.15em;
            color: #333;
        }
        .admin-actions {
            display: flex;
            justify-content: center;
            gap: 32px;
            flex-wrap: wrap;
        }
        .dashboard-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 210px;
            height: 150px;
            border-radius: 14px;
            text-decoration: none;
            color: #fff;
            font-size: 1.15em;
            font-weight: 500;
            box-shadow: 0 2px 12px rgba(111,45,168,0.10);
            transition: transform 0.13s, box-shadow 0.13s;
            position: relative;
        }
        .dashboard-card i {
            font-size: 2.5em;
            margin-bottom: 18px;
        }
        .dashboard-card span {
            margin-top: 4px;
        }
        .dashboard-card:hover {
            transform: translateY(-6px) scale(1.04);
            box-shadow: 0 8px 24px rgba(111,45,168,0.16);
            opacity: 0.93;
        }
        .card-blue {
            background: linear-gradient(135deg, #0275d8 70%, #00b4d8 100%);
        }
        .card-violet {
            background: linear-gradient(135deg, #6f2da8 70%, #a259e6 100%);
        }
        .card-blue-light {
            background: linear-gradient(135deg, #00b4d8 70%, #48e0e4 100%);
        }
        @media (max-width: 700px) {
            .admin-actions {
                flex-direction: column;
                gap: 18px;
            }
            .dashboard-card {
                width: 100%;
                min-width: 0;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
@endsection