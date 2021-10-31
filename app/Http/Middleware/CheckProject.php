<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckProject
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $id = Auth::id();
        $route_project = $request->route('project');

        if($route_project) {
            if (!$route_project->users->contains($id) && !Auth::user()->hasRole('Administrator')) {
                return redirect('/admin/dashboard');
            }
        }

        return $next($request);
    }
}
