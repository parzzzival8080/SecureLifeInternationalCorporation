<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BronzeWalletLog extends Model
{
    protected $fillable = [
        'wallet_id', 'amount', 'remarks',
    ];

    public function bronzeWallet() {
        return $this->belongsTo('App\BronzeWallet', 'wallet_id');
    }
}
