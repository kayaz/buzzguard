<?php

use App\Models\Year;

if (! function_exists('projectsMenu')) {
    function projectsMenu()
    {
        return Year::with('activeProjects')->get();;
    }
}
