<?php namespace App\Repositories;

use App\Models\Chat;

class ChatRepository implements ChatRepositoryInterface
{
    public function getAllForProject(int $id, int $parent_id, int $limit){
        return Chat::orderBy('id', 'desc')->where(['project_id' => $id, 'parent_id' => $parent_id])->withCount('posts')->with('author')->paginate($limit);;
    }

}
