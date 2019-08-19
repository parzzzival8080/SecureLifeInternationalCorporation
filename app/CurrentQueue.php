<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentQueue extends Model
{
    protected $table = 'current_queues';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'queue_id',
        'queue_count',
        'exit'
    ];
}
