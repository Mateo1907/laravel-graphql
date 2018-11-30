<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Collection;

class PostService extends BaseService
{
    protected $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

}