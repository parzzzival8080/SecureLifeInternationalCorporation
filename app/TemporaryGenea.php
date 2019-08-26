<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemporaryGenea extends Model
{
    protected $table = 'temporary_geneas';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'reference_id',
        'referal_id',
        'position',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
