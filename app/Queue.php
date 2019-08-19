<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $table = 'queues';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['user_id', 'exit'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
