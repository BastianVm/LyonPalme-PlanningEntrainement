@extends('layouts.app')

@section('content')
    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 60px;">
        <div style="background: linear-gradient(120deg, #f6fafd 60%, #e9e3f7 100%); border-radius: 22px; box-shadow: 0 8px 32px 0 rgba(111,45,168,0.10); padding: 48px 36px; min-width: 350px; max-width: 98vw;">
            <div style="display: flex; flex-direction: column; align-items: center;">
                <!-- Logo local de secours si le lien distant ne fonctionne pas -->
                <img src="/images/LyonPalme.png" alt="LyonPalme" style="height: 220px; margin-bottom: 18px;">
                <h2 style="margin-bottom: 10px; color: #6f2da8; font-weight: bold; text-align: center; font-size: 2.1rem;">
                    Bienvenue {{ Auth::user()->name ?? '' }} !
                </h2>
                <p style="margin-bottom: 32px; color: #333; text-align: center; font-size: 1.1rem;">
                    Retrouvez ici toutes vos informations et accès rapides au club LyonPalme.
                </p>
            </div>
            <div style="display: flex; flex-direction: column; gap: 18px; margin-bottom: 32px;">
                <a href="{{ route('planning.index') }}" class="btn btn-primary" style="width: 260px; margin: 0 auto; font-size: 1.13rem; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-calendar-alt" style="margin-right:10px; font-size: 1.3em;"></i> Voir les séances
                </a>
                <a href="{{ route('entrainements.index') }}" class="btn btn-success" style="width: 260px; margin: 0 auto; font-size: 1.13rem; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-dumbbell" style="margin-right:10px; font-size: 1.3em;"></i> Voir les entraînements
                </a>
            </div>
            <div style="border-top: 1px solid #e0e0e0; padding-top: 18px; text-align: center;">
                <span style="color: #6f2da8; font-weight: 500; font-size: 1.05rem;">
                    Besoin d'aide ou d'informations ? 
                    <a href="mailto:contact@lyonpalme.com" style="color: #00b4d8; text-decoration: underline;">
                        Contactez le club
                    </a>
                </span>
                <div style="margin-top: 10px;">
                    <a href="https://www.facebook.com/lyonpalme" target="_blank" style="margin: 0 8px; color: #4267B2;"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="https://www.instagram.com/lyonpalme/" target="_blank" style="margin: 0 8px; color: #C13584;"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="https://www.tiktok.com/@lyonpalme" target="_blank" style="margin: 0 8px; color: #000;"><i class="fab fa-tiktok fa-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Font Awesome CDN pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
@endsection