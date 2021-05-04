<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProjectFile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'name',
        'file'
    ];

    public function imageUpload($file)
    {
        $name = Str::slug($file->getClientOriginalName(), '-') . '_' . Str::random(3) . '.' .$file->getClientOriginalExtension();
        $file->storeAs('projects/files', $name, 'public_uploads');
        $this->update(['file' => $name, 'name' => $file->getClientOriginalName()]);
    }

    public function getIconAttribute() {
        return File::extension($this->file);;
    }
}
