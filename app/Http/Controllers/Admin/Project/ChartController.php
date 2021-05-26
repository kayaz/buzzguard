<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ChartController extends Controller
{
    public function index(Project $project)
    {
        return view('admin.project.chart.index', [
            'project' => $project
        ]);
    }
}
