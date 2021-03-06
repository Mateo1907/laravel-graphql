<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class PasswordReset extends Model
{
    use Uuids;

    public $incrementing = false;
    protected $table = 'password_resets';
    protected $fillable = [
        'user_id',
        'email',
        'token',
        'used'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
