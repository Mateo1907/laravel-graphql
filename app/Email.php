<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Email extends Model
{
    use Uuids;

    protected $table = 'emails_queue';
    public $incrementing = false;
    protected $fillable = [
        'user_id',
        'recipient',
        'subject',
        'content',
        'sent',
        'to_send_at',
        'sent_at',
        'vendor_response'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
