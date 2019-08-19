<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenealogyMatchLog extends Model
{
    protected $fillable = [
        'user_id', 'genealogy_id', 'remarks',
    ];

    public function genealogy() {
        return $this->belongsTo('App\Genealogy', 'id', 'genealogy_id');
    }
}
