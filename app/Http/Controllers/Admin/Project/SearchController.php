<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('term');

        if($keyword) {
            $result = Project::where('name', 'LIKE', '%' .$keyword. '%')->orderByDesc('id')->get(['name', 'id']);
            return response()->json($result);
        }
    }
}


