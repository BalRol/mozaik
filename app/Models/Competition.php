<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A Competition modell osztály reprezentál egy versenyt az adatbázisban.
 */
class Competition extends Model
{
    /**
     * A modell töltendő mezőinek listája.
     *
     * @var array
     */
    protected $fillable = [
        'name',    // A verseny neve
        'year',    // A verseny éve
        'location', // A verseny helyszíne
    ];

    /**
     * A modellhez tartozó adattábla neve.
     *
     * @var string
     */
    protected $table = 'competition';

    /**
     * A modell elsődleges kulcsának neve.
     *
     * @var array
     */
    protected $primaryKey = ['name', 'year'];

    /**
     * A kulcsok automatikus növekedésének letiltása.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * A modell időbélyegzők használatának letiltása.
     *
     * @var bool
     */
    public $timestamps = false;

}
