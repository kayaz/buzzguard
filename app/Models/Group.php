<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Group extends Model
{

    use LogsActivity;

    protected static $logName = 'Groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'projects'
    ];

    public function setProjectsAttribute($value)
    {
        $this->attributes['projects'] = implode(',',$value);
    }

    public function getProjectsAttribute($value)
    {
        return explode(',',$value);
    }
}
