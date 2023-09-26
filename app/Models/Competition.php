<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
            'name', // Add it here
            'year',
            'location',
        ];
    protected $table = 'competition';
    protected $primaryKey = ['name', 'year'];
    public $incrementing = false;
    public $timestamps = false;

    // A modell többi része
}
?>
