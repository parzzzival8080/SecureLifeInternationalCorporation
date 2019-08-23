<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informations extends Model
{
    protected $table = 'informations';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'mi',
        'photo',
        'address',
        'birthdate',
        'contact',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
