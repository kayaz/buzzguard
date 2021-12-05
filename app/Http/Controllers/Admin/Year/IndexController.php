<?php

namespace App\Http\Controllers\Admin\Year;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Year;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    function __construct(){
        $this->middleware('permission:year-list|year-create', ['only' => ['index','store']]);
        $this->middleware('permission:year-create', ['only' => ['create','store']]);
    }

    public function index()
    {
        return view('admin.year.index', ['list' => Year::orderBy('year', 'desc')->get()]);
    }

    public function create()
    {
        return view('admin.year.form', [
            'cardTitle' => 'Dodaj rok',
            'backButton' => route('admin.year.index')
        ])->with('entry', Year::make());
    }

    public function store(Request $request)
    {
        Year::create($request->except(['_token', 'submit']));
        return redirect(route('admin.year.index'))->with('success', 'Nowy rok dodany');
    }

    public function show(Year $year)
    {
        $yearProjects = Project::with('client')
            ->where('year', $year->year)
            ->where('status', 1)
            ->orderBy('month', 'desc')
            ->get();

        return view('admin.year.show', [
            'yearprojects' => $yearProjects,
            'year' => $year
        ]);
    }

    public function closed(Year $year)
    {
        $yearProjects = Project::with('client')
            ->where('year', $year->year)
            ->where('status', 2)
            ->orderBy('month', 'desc')
            ->get();

        return view('admin.year.closed', [
            'yearprojects' => $yearProjects,
            'year' => $year
        ]);
    }

}
