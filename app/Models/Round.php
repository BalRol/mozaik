<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A Forduló modell osztály reprezentál egy fordulót az adatbázisban.
 */
class Round extends Model
{
    /**
     * A modell töltendő mezőinek listája.
     *
     * @var array
     */
    protected $fillable = [
        'name',               // A forduló neve
        'location',           // A forduló helyszíne
        'date',               // A forduló dátuma
        'competition_name',   // A verseny neve, amelyhez a forduló tartozik
        'competition_year',   // A verseny éve, amelyhez a forduló tartozik
    ];

    /**
     * A modellhez tartozó adattábla neve.
     *
     * @var string
     */
    protected $table = 'round';

    /**
     * Az időbélyegzők használatának letiltása.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * A forduló kapcsolata a Competition modellhez.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competition()
    {
        return $this->belongsTo('App\Models\Competition', 'competition_name', 'competition_year');
    }

    /**
     * A fordulóhoz tartozó versenyzők kapcsolata.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function competitor()
    {
        return $this->hasMany('App\Models\Competitor', 'round_id');
    }

}
