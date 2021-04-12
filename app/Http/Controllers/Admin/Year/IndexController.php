<?php

namespace App\Http\Controllers\Admin\Year;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Year;

class IndexController extends Controller
{

    public function show(Year $year)
    {
        $yearProjects = Project::all()->where('year', $year->year)->where('status', 1);
        return view('admin.year.index', [
            'yearprojects' => $yearProjects,
            'year' => $year
        ]);
    }

    public function closed(Year $year)
    {
        $yearProjects = Project::all()->where('year', $year->year)->where('status', 0);
        return view('admin.year.closed', [
            'yearprojects' => $yearProjects,
            'year' => $year
        ]);
    }

}
