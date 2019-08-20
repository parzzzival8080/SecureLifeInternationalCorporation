<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'role_id',
        'type',
        'status',
        'code',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Bronze Package Model Relations
    public function genealogy() {
        return $this->hasOne('App\Genealogy', 'user_id', 'id');
    }

    public function references() {
        return $this->hasMany('App\Genealogy', 'reference_id', 'id');
    }

    public function referals() {
        return $this->hasMany('App\Genealogy', 'referal_id', 'id');
    }

    public function userProductLogs() {
        return $this->hasMany('App\UseProductLog');
    }

    public function userAccountStatus() {
        return $this->hasOne('App\UserAccountStatus');
    }

    public function wallet() {
        return $this->hasOne('App\Wallets');
    }
}
