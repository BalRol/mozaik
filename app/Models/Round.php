<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $table = 'round';
    public $timestamps = true;

    public function competition()
    {
        return $this->belongsTo('App\Models\Competition', 'competition_name', 'competition_year');
    }

    public function competitor()
    {
        return $this->hasMany('App\Models\Competitor', 'round_id');
    }

    // A modell többi része
}
