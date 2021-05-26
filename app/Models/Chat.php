<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'parent_id',
        'user_id',
        'data',
        'status',
        'name',
        'content'
    ];

    public function posts()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
