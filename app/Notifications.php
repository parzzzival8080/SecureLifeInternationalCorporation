<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notifications';
    public $primaryKey = 'id';
    public $timestamps = true;
}
