<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    protected $table = 'wallets';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'total_earnings',
        'current_balance',
    ];
}
