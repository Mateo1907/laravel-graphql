<?php 

namespace App\Repositories;

use App\PasswordReset;

class PasswordResetRepository extends BaseRepository 
{
    public $model;

    public function __construct(PasswordReset $passwordReset)
    {
        $this->model = $passwordReset;
    }
}