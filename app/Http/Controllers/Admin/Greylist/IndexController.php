<?php

namespace App\Http\Controllers\Admin\Greylist;

use App\Http\Controllers\Controller;
use App\Http\Requests\GreylistFormRequest;
use App\Models\Greylist;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.greylist.index', ['list' => Greylist::orderBy('id', 'asc')->get()]);
    }

    public function create()
    {
        return view('admin.greylist.form', [
            'cardTitle' => 'Dodaj adres IP',
            'backButton' => route('admin.greylist.index')
        ])->with('entry', Greylist::make());
    }


    public function store(GreylistFormRequest $request)
    {
        Greylist::create($request->except(['_token', 'submit']));
        return redirect(route('admin.greylist.index'))->with('success', 'Nowy adres IP dodany');
    }

    public function edit($id)
    {
        return view('admin.greylist.form', [
            'entry' => Greylist::find($id),
            'cardTitle' => 'Edytuj adres IP',
            'backButton' => route('admin.greylist.index')
        ]);
    }

    public function update(GreylistFormRequest $request, Greylist $greylist)
    {
        $greylist->update($request->except(['_token', 'submit']));
        return redirect(route('admin.greylist.index'))->with('success', 'Adres IP zaktualizowany');
    }

    public function destroy($id)
    {
        $entry = Greylist::find($id);
        $entry->delete();
        Session::flash('success', 'Adres IP usunięty');
        return response()->json('Deleted', 200);
    }
}
