<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bracket extends Model
{
    protected $table = 'brackets';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['currentBracket', 'bracketCount', 'exit'];
}
