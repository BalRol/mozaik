<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A User modell osztály reprezentál egy felhasználót az adatbázisban.
 */
class User extends Model
{
    /**
     * A modellhez tartozó adattábla neve.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * Az elsődleges kulcs(ok) meghatározása.
     *
     * @var array
     */
    protected $primaryKey = ['name', 'email'];

    /**
     * Az automatikus növekvő azonosító letiltása.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Az időbélyegzők használatának engedélyezése.
     *
     * @var bool
     */
    public $timestamps = true;

}
