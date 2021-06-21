<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'client_id',
        'name',
        'year',
        'content',
        'date_start',
        'date_end',
        'keywords',
        'description',
        'month',
        'days'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'project_id', 'id');
    }

    public function stats_posts()
    {
        return $this->hasMany(Post::class, 'project_id', 'id');
    }


    //$db->select()->from('posty', array('*',' count(posty.data_tag) as num'))->group('data_tag')


    public function files()
    {
        return $this->hasMany(ProjectFile::class, 'project_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('id', 'limit', 'limit_project');
    }

    public function client()
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }
}
