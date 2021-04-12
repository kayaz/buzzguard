<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->hasMany(Post::class, 'project_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function client()
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }
}
