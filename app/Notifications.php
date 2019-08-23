<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notifications';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'type',
        'data',
        'read_at'
    ];
    
    public function user() {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
