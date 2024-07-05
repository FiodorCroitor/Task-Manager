<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/admin/dashboard';

    public function boot(): void
    {
        parent::boot();

        $this->configureRateLimiting();
    }


    public function map(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));


        Route::prefix('user')
            ->middleware(['web'])
            ->group(static function () {
                foreach (File::allFiles(base_path('routes/v1')) as $file) {
                    require $file->getPathname();
                }
            });

        Route::prefix('user')
            ->middleware(['web', 'auth:sanctum', 'verified'])
            ->group(static function () {
                foreach (File::allFiles(base_path('routes/v1/authorized')) as $file) {
                    require $file->getPathname();
                }
            });

        Route::middleware('web')->group(base_path('routes/web.php'));
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
