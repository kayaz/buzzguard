<?php

namespace App\Http\Controllers\Admin\Log;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class IndexController extends Controller
{
    function __construct(){
        $this->middleware('permission:log-list', ['only' => ['index']]);
    }

    public function index()
    {
        return view('admin.log.index', ['list' => Activity::all()->sortByDesc("id")]);
    }
}
