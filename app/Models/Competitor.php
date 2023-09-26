<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A Competitor modell osztály reprezentál egy versenyzőt az adatbázisban.
 */
class Competitor extends Model
{
    /**
     * A modell töltendő mezőinek listája.
     *
     * @var array
     */
    protected $fillable = [
        'name',     // A versenyző neve
        'email',    // A versenyző e-mail címe
        'round_id', // A forduló ID-ja, amelyhez a versenyző tartozik
    ];

    /**
     * A modellhez tartozó adattábla neve.
     *
     * @var string
     */
    protected $table = 'competitor';

    /**
     * Az időbélyegzők használatának letiltása.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * A versenyző kapcsolata a Round modellhez.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function round()
    {
        return $this->belongsTo('App\Models\Round', 'round_id');
    }
}
