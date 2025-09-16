<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->runningInConsole())
            return;

        Log::channel('fingerprint')->info('Project accessed', [
            'machine_user' => get_current_user(),
            'hostname' => gethostname(),
            'os' => php_uname(),
            'ip' => request()->ip(),
            'timestamp' => now()->toDateTimeString()
        ]);
    }
}
