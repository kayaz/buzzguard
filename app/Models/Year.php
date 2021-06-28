<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Year extends Model
{
    use HasFactory;
    use LogsActivity;
    public $timestamps = false;
    protected static $logName = 'Year';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year'
    ];

    protected $primaryKey = 'year';

    public function activeProjects()
    {
        return $this->hasMany(Project::class, 'year', 'year')->where('projects.status', '=', 1);
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'year', 'year');
    }
}
