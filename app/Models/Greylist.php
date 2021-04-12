<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Greylist extends Model
{

    use LogsActivity;

    protected static $logName = 'Greylist';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'reason',
        'route'
    ];
}
