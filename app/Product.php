<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'points',
    ];

    public function userProductLogs() {
        return $this->hasMany('App\UseProductLog');
    }
}
