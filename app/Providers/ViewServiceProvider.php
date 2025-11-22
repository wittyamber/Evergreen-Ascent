<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share data with the navigation component
        View::composer('layouts.navigation', function ($view) {
            $unreadMessagesCount = 0;
            if (auth()->check() && auth()->user()->role === 'applicant') {
                // For a full notification system, you would query unread notifications.
                // For now, we'll keep it simple and just link to the page.
                // This is a placeholder for a future unread count feature.
            }
            $view->with('unreadMessagesCount', $unreadMessagesCount);
        });
    }
}
