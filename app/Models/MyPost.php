<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MyPost extends Model
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
        'seo',
        'file'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function upload($title, $file, $old_file = null)
    {
        if ($old_file) {

            $file_path = public_path('uploads/posts/' . $old_file);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $name = Str::slug($title, '-') . '_' . Str::random(12) . '.' .$file->getClientOriginalExtension();
        $file->storeAs('posts', $name, 'public_uploads');
        $this->update(['file' => $name ]);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($post) {
            if ($post->file) {
                $file_path = public_path('uploads/posts/' . $post->file);
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
        });
    }
}
