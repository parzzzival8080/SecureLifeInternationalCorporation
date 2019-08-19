<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenealogyMatchPoint extends Model
{
    protected $fillable = [
        'genealogy_id', 'matches', 'product_points', 'incentives_points',
    ];

    public function genealogy() {
        return $this->belongsTo('App\Genealogy');
    }
}
