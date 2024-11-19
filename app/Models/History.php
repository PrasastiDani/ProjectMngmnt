<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = 'histories'; 
    protected $primaryKey = 'history_id';
    /**
     * fillable
     *
     * @var array
     */

    protected $fillable = [
        'user_id',
        'reservation_id',
        'photo_link',
        'created_at'
    ];
        /* Relation */
        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }
        public function reservations()
        {
            return $this->belongsTo(Reservation::class, 'reservation_id','reservation_id');
        }
}
