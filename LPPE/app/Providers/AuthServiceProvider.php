<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\LPPE_Seances;
use App\Policies\LPPESeancesPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
       // \App\Models\LPPE_Seances::class => \App\Policies\LPPESeancesPolicy::class,
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
