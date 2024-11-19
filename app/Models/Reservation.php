<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $primaryKey = 'reservation_id';
    /**
     * fillable
     *
     * @var array
     */

    protected $fillable = [
        'user_id',
        'package_id',
        'event_date',
        'location',
        'title',
        'number_of_people',
        'status',
        'note',
        'start_time',
        'end_time',
    ];

    /* Relation dari*/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'pakage_id');
    }

    /* Untuk */
    public function history()
    {
        return $this->hasMany(History::class, 'reservation_id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class, 'reservation_id');
    }
}
