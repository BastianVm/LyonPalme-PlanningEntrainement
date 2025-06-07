<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class LogUserLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        Log::info('Connexion utilisateur', [
            'user_id' => $event->user->id,
            'email' => $event->user->email,
            'ip' => request()->ip(),
            'date' => now(),
        ]);
    }
}