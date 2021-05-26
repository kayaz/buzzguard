<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Models\ProjectFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $project_file = ProjectFile::create($request->merge([
            'project_id' => $request->get('project_id')
        ])->only([
            'project_id'
        ]));

        if ($request->hasFile('qqfile')) {
            $project_file->imageUpload($request->file('qqfile'));
        }
        Session::flash('success', 'Plik dodany');
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $projectFile = ProjectFile::find($id);

        if ($projectFile->file) {
            $file_path = public_path('uploads/projects/files/' . $projectFile->file);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $projectFile->delete();
        Session::flash('success', 'Plik usunięty');
        return redirect(route('admin.project.show', $projectFile->project_id));
    }
}
