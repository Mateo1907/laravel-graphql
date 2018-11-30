<?php 

namespace App\Repositories;

use App\User;

class UserRepository extends BaseRepository 
{
    public $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
}