<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    protected $table = 'notifs';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['type', 'notifiable_id', 'data', 'read_at'];
}
