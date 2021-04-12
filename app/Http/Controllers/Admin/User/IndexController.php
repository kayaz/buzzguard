<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\User;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;

class IndexController extends Controller
{
    public function __construct() {

    }

    public function index()
    {
        return view('admin.user.index', ['list' => User::all()]);
    }

    public function create()
    {
        return view('admin.user.form', [
            'cardTitle' => 'Dodaj użytkownika',
            'roles' => Role::pluck('name','name')->all(),
            'backButton' => route('admin.user.index'),
            'selected' => ''
        ])->with('entry', User::make());
    }

    public function store(UserFormRequest $request)
    {
        $user = User::create($request->merge([
            'password' => Hash::make($request->get('password')),
        ])->except(['_token', 'submit', 'confirm-password', 'roles']));

        $user->assignRole($request->input('roles'));

        return redirect(route('admin.user.index'))->with('success', 'Użytkownik dodany');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('admin.user.form', [
            'cardTitle' => 'Edytuj użytkownika: '.$user->name,
            'roles' => $roles,
            'selected' => $userRole,
            'backButton' => route('admin.user.index'),
            'entry' => $user
        ]);
    }

    public function update(UserFormRequest $request, $id)
    {
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        //$user->update($request->except(['_token', 'submit']));
        return redirect(route('admin.user.index'))->with('success', 'Użytkownik zaktualizowany');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        Session::flash('success', 'Użytkownik usunięty');
        return response()->json('Deleted', 200);
    }
}
