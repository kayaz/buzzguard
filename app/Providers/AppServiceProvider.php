<?php

namespace App\Providers;

use Request;

use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;
use App\Models\Settings;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Settings::class, function () {
            return Settings::make(storage_path('app/settings.json'));
        });

        $this->app->bind(
            'App\Repositories\ChatRepositoryInterface',
            'App\Repositories\ChatRepository'
        );
        $this->app->bind(
            'App\Repositories\PostRepositoryInterface',
            'App\Repositories\PostRepository'
        );
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Activity::saving(function (Activity $activity) {

            $activity->properties = collect([
                    "route"         => Request::getPathInfo(),
                    "ipAddress"     => Request::ip(),
                    "userAgent"     => Request::header('user-agent'),
                    "locale"        => Request::header('accept-language'),
                    "referer"       => Request::header('referer'),
                    "methodType"    => Request::method()
            ]);
        });
    }
}
