<?php

namespace App;

use App\Notifications\UserRegistered;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'firstname', 'mi', 'email', 'username', 'password', 'type', 'account_type', 'photo', 'status', 'address', 'sponsor', 'code', 'proof', 'birthdate', 'contact'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function queues(){
        return $this->hasMany(Queue::class);
    }
    
    public function keys(){
        return $this->hasMany(Key::class);
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
}
