<?php

namespace App\Services;

use App\User;
use App\PasswordReset;
use App\Jobs\SendEmailJob;
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

    public function register(array $payload) : User
    {
        $user = $this->repository->create($payload);
        SendEmailJob::dispatch($user->email, 'afterRegister', ['user' => $user]);

        return $user;
    }

}