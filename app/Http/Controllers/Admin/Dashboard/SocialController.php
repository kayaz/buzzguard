<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialFormRequest;
use Spatie\Valuestore\Valuestore;

class SocialController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.social.index');
    }

    public function store(SocialFormRequest $request)
    {
        $settings = Valuestore::make(storage_path('app/settings.json'));
        $settings->put($request->except(['_token', 'submit']));
        return redirect(route('admin.dashboard.social.index'))->with('success', 'Ustawienia zostały zapisane');
    }
}
