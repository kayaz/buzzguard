<?php

namespace App\Http\Controllers\Admin\Log;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class IndexController extends Controller
{

    public function index()
    {
        return view('admin.log.index', ['list' => Activity::all()->sortByDesc("id")]);
    }

    public function destroy($id)
    {
        //
    }
}
