<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

use App\Models\Year;

class ProjectServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin/submenu', function ($view) {
            $user = Auth::user();
            if($user) {
                if (!$user->hasRole('Administrator')) {
                    $projects = $user->userProjects()->get();
                    $user_projects_years = $projects->pluck('year', 'year');
                    $view->with(['projects_dropdown' => $projects, 'projects_years' => $user_projects_years]);
                }
            }
        });
    }
}
