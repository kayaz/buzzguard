<?php

namespace App\Http\Controllers\Admin\PrivateProject;

use App\Http\Controllers\Controller;
use App\Models\Post;
use DataTables;

class AjaxController extends Controller
{

    public function show($id)
    {
        $posts = Post::select()->where('project_id', '=', $id);

        return Datatables::of($posts)
            ->addColumn('user_id', function (Post $post) {
                return $post->users->surname.' '.$post->users->name;
            })
            ->addColumn('actions', function ($row) {
                return view('admin.private.datatables.actions', ['row' => $row]);
            })
            ->editColumn('url', function ($row){
                return '<a href="'.$row->url.'" target="_blank"><i class="fe-link"></i></a>';
            })
            ->editColumn('thread', function ($row){
                return ($row->thread) ? '<span class="online"></span>' : '<span class="offline"></span>';
            })
            ->editColumn('seo', function ($row){
                return ($row->seo) ? '<span class="online"></span>' : '<span class="offline"></span>';
            })
            ->editColumn('reaction', function ($row){
                return ($row->reaction) ? '<span class="online"></span>' : '<span class="offline"></span>';
            })
            ->editColumn('age_group', function ($row){
                return '<div class="text-center">'.age($row->age_group).'</div>';
            })
            ->editColumn('sentiment', function ($row){
                return sentiment($row->sentiment);
            })
            ->rawColumns(['thread', 'reaction', 'seo', 'age_group', 'sentiment', 'url', 'actions'])
            ->make(true);
    }

}
