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

    public function user() {
        return $this->belongsTo('App\Users', 'user_id');
    }

    public function walletLog() {
        return $this->hasMany('App\WalletLogs', 'wallet_id', 'id');
    }
}
