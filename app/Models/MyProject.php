<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyProject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'user_id',
        'name',
        'year'
    ];

    public function posts()
    {
        return $this->hasMany(MyPost::class, 'project_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($project) {
            foreach($project->posts() as $post)
            {
                $post->delete();
            }
        });
    }
}
