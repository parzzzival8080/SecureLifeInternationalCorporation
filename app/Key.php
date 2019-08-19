<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    protected $table = 'keys';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['user_id', 'key', 'status', 'investment'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
