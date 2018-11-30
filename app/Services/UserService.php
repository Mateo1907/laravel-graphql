<?php

namespace App\Services;

use App\User;
use App\Services\BaseService;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService extends BaseService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

}