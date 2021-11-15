<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MyProject;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class PrivateProject
{
    public function privateProject(User $user, MyProject $privateProject)
    {
        if (Auth::user()->hasRole('Administrator')) {
            return true;
        } else {
            return $user->id === $privateProject->user_id
                ? Response::allow()
                : Response::deny('You do not own this project.');
        }
    }
}
