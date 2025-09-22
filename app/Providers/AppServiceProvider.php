<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        // Skip when running in console (migrations, queues, etc.)
        if (app()->runningInConsole()) {
            return;
        }

        // Force HTTPS on Render in production
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Your existing fingerprint log
        Log::channel('fingerprint')->info('Project accessed', [
            'machine_user' => get_current_user(),
            'hostname'     => gethostname(),
            'os'           => php_uname(),
            'ip'           => request()->ip(),
            'timestamp'    => now()->toDateTimeString(),
        ]);
    }
}
