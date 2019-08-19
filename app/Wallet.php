<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['user_id', 'amount', 'remarks', 'investment', 'encashed'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
