<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $table = 'competition';
    protected $primaryKey = ['name', 'year'];
    public $incrementing = false;
    public $timestamps = true;

    // A modell többi része
}
?>
