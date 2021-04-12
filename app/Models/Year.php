<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

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
