<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $table = 'requests';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'request_image',
        'investment',
        'status'
    ];
    
    public function user() {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
