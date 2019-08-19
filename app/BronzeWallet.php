<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BronzeWallet extends Model
{
    protected $fillable = [
        'genealogy_id', 'current_balance', 'total_earnings',
    ];

    public function genealogy() {
        return $this->belongsTo('App\Genealogy', 'genealogy_id');
    }

    public function bronzeWalletLog() {
        return $this->hasMany('App\BronzeWalletLog', 'wallet_id', 'id');
    }
}
