<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    protected $table = 'competitor';
    public $timestamps = true;

    public function round()
    {
        return $this->belongsTo('App\Models\Round', 'round_id');
    }

    // A modell többi része
}