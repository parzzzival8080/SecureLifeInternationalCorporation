<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletLogs extends Model
{
    protected $table = 'wallet_logs';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'wallet_id',
        'amount',
        'remarks',
    ];
}
