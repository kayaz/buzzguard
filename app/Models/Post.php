<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'user_id',
        'date',
        'nick',
        'thread',
        'website',
        'url',
        'type',
        'sentiment',
        'reaction',
        'age_group',
        'content',
        'additional',
        'category',
        'seo'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
