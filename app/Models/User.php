<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use LogsActivity;
    protected static $logName = 'Użytkownicy';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'client'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function userProjects()
    {
        //return $this->hasManyThrough(Project::class, UserProject::class, 'user_id', 'id', 'id', 'project_id');
        return $this->belongsToMany(Project::class)->using(ProjectUser::class)->orderByDesc('projects.year');
    }
}
