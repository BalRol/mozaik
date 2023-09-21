<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = ['name', 'email'];
    public $incrementing = false;
    public $timestamps = true;

    // A modell többi része
}
