<?php

namespace App\Http\Controllers\Admin\ClientProject;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;

class IndexController extends Controller
{
    function __construct(){
        $this->middleware('permission:clientgroup-list', ['only' => ['show']]);
    }

    public function show($id)
    {
        $client = User::find($id);
        $projects = Project::where('client_id', $id)->get();
        return view('admin.clientproject.show', [
            'projects' => $projects,
            'client' => $client
        ]);
    }
}
