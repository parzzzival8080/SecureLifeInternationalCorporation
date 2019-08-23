<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keys extends Model
{
    protected $table = 'keys';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'key',
        'investment',
        'status'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
