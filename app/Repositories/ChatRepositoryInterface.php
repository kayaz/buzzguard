<?php namespace App\Repositories;

interface ChatRepositoryInterface{

    public function getAllForProject(int $id, int $parent_id, int $limit);

}
