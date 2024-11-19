<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments'; 
    protected $primaryKey = 'payment_id';
    /**
     * fillable
     *
     * @var array
     */

    protected $fillable = [
        'reservation_id',
        'amount',
        'payment_method',
        'payment_date',
        'status',
        'proof_of_payment',
    ];

        /* Relation dari*/
        public function reservations()
        {
            return $this->belongsTo(Reservation::class, 'reservation_id', 'reservation_id' );
        }

        /* Unutuk */
        public function income()
        {
            return $this->hasMany(Income::class, 'payment_id');
        }
}
