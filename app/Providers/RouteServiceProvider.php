<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register the application routes.
     *
     * @return void
     */
    public function boot(): void
    {
        // Define the default route group for API routes
        Route::middleware('api') // Apply the 'api' middleware to the routes
            ->prefix('api') // Ensure routes are prefixed with /api
            ->group(base_path('routes/api.php')); // Load routes from api.php file

        // Optionally add more route groups here, such as for web routes
    }
}
