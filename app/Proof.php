<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proof extends Model
{
    protected $table = 'proofs';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['user_id', 'image', 'investment', 'status'];
}
