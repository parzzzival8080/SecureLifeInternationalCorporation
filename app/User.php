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

    public function roles() {
        return $this->belongsTo('App\Roles', 'role_id', 'id');
    }

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

    public function informations() {
        return $this->hasOne('App\Informations');
    }

    public function keys() {
        return $this->hasMany('App\Keys');
    }

    public function diamondQueues() {
        return $this->hasMany('App\DiamondQueues');
    }

    public function notifications() {
        return $this->hasMany('App\Notifications');
    }

    public function requests() {
        return $this->hasMany('App\Requests');
    }

    public function sponsorships() {
        return $this->hasMany('App\Sponsorships');
    }
}
