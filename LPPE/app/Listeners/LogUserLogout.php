<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;

class LogUserLogout
{
    /**
     * Handle the event.
     */
    public function handle(Logout $event)
    {
        Log::info('Déconnexion utilisateur', [
            'user_id' => $event->user->id ?? null,
            'email' => $event->user->email ?? null,
            'ip' => request()->ip(),
            'date' => now(),
        ]);
    }
}