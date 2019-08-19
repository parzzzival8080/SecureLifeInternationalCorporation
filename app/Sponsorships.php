<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorships extends Model
{
    protected $table = 'sponsorships';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'sponsor_id',
    ];
}
