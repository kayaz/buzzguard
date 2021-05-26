<?php namespace App\Repositories;

use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function countProjectPosts(int $id){
        return Post::where('project_id', '=', $id)->count();
    }

}
