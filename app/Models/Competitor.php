<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'round_id'
    ];



    protected $table = 'competitor';
    public $timestamps = false;

    public function round()
    {
        return $this->belongsTo('App\Models\Round', 'round_id');
    }

    // A modell többi része
}
