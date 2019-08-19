<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genealogy extends Model
{
    protected $fillable = [
        'user_id', 'reference_id', 'referal_id', 'position',
    ];

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function reference() {
        return $this->hasOne('App\User', 'id', 'reference_id');
    }

    public function referal() {
        return $this->hasOne('App\User', 'id', 'referal_id');
    }

    public function genealogyMatchPoint() {
        return $this->hasOne('App\GenealogyMatchPoint');
    }

    public function genealogyMatchLog() {
        return $this->hasMany('App\GenealogyMatchLog');
    }

    public function bronzeWallet() {
        return $this->hasOne('App\BronzeWallet');
    }

    public function groupSalesLog() {
        return $this->hasMany('App\GroupSalesLog');
    }
}
