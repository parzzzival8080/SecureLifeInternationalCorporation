<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'genealogy_id', 'matches', 'remarks',
    ];

    public function userProductLogs() {
        return $this->hasMany('App\UseProductLog');
    }
}
