<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountFormRequest;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class IndexController extends Controller
{
    public function edit($id)
    {
        return view('admin.account.form', [
            'entry' => User::find($id)
        ]);
    }

    public function update(AccountFormRequest $request, $id)
    {
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        return redirect(route('admin.account.edit', $id))->with('success', 'Użytkownik zaktualizowany');
    }
}
