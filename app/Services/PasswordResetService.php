<?php

namespace App\Services;

use App\User;
use App\PasswordReset;
use App\Jobs\SendEmailJob;
use App\Services\BaseService;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\PasswordResetRepository;

class PasswordResetService extends BaseService
{
    protected $repository;

    public function __construct(PasswordResetRepository $repository)
    {
        $this->repository = $repository;
    }

    public function sendUserToken(User $user) : bool 
    {
        try {
            $token = $this->repository->create([
                'user_id' => $user->id,
                'email' => $user->email,
                'token' => str_random(40)
            ]);
    
            SendEmailJob::dispatch($user->email, 'sendUserToken', ['token' => $token]);
            return true;
        } catch (\Exception $e) {
            \Log::debug('[SendUserToken] error', ['msg' => $e->getMessage()]);
            return false;
        }
    }

}