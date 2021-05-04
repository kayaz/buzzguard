<?php

use App\Models\User;

if (! function_exists('clientsMenu')) {
    function clientsMenu()
    {
        return User::where('client', 1)->orderBy('name')->get(['id', 'name', 'surname']);
    }
}
