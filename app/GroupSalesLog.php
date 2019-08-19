<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupSalesLog extends Model
{
    protected $fillable = [
        'genealogy_id', 'matches', 'remarks',
    ];

    public function genealogy() {
        return $this->belongsTo('App\Genealogy');
    }//
}
