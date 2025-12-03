<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        \App\Models\JobPosting::class => \App\Policies\JobPostingPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 2. ADD THIS BLOCK
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
