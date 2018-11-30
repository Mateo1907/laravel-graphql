<?php

namespace App\Repositories;

use App\Post;

class PostRepository extends BaseRepository 
{
    public $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }
}