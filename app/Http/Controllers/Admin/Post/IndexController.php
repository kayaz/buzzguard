<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use DataTables;
use Illuminate\Http\Request;


class IndexController extends Controller
{

    public function show(Request $request, $id)
    {
        $posts = Post::select()->where('project_id', '=', $id)->orderByDesc('id');

        return Datatables::of($posts)
            ->addColumn('user_id', function (Post $post) {
                return $post->users->surname.' '.$post->users->name;
            })
            ->addColumn('actions', function ($row) {
                return view('admin.project.datatables.actions', ['row' => $row]);
            })
            ->editColumn('url', function ($row){
                return '<a href="'.$row->url.'" target="_blank"><i class="fe-link"></i></a><span class="d-none">'.$row->url.'</span>';
            })
            ->editColumn('thread', function ($row){
                return ($row->thread) ? '<span class="online"></span><span class="d-none">'.$row->thread.'</span>' : '<span class="offline"></span><span class="d-none">'.$row->thread.'</span>';
            })
            ->editColumn('seo', function ($row){
                return ($row->seo) ? '<span class="online"></span><span class="d-none">'.$row->seo.'</span>' : '<span class="offline"></span><span class="d-none">'.$row->seo.'</span>';
            })
            ->editColumn('reaction', function ($row){
                return ($row->reaction) ? '<span class="online"></span><span class="d-none">'.$row->reaction.'</span>' : '<span class="offline"></span><span class="d-none">'.$row->reaction.'</span>';
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

    public function modal(Request $request)
    {
        $id = $request->get('id');
        return view('admin.project.post.modal', Post::find($id))->render();
    }

}
