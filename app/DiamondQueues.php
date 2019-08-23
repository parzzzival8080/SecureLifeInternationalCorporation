<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiamondQueues extends Model
{
    protected $table = 'diamond_queues';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'exit',
        'exited'
    ];
    
    public function user() {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
