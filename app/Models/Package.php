<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages'; 
    protected $primaryKey = 'pakage_id'; 

    /**
     * fillable
     *
     * @var array
     */

    protected $fillable = [
        'pakage_name',
        'description',
        'price',
        'duration',
        'imageUrls',
    ];

    /* Relasi */
    public function reservations()
    {
     return $this->hasMany(Reservation::class, 'package_id', 'pakage_id'); 
    }
}
