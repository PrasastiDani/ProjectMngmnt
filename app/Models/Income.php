<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = 'incomes'; 
    protected $primaryKey = 'income_id';
    /**
     * fillable
     *
     * @var array
     */

    protected $fillable = [
        'amount',
        'source',
        'payment_id',
        'date',
        'description',
    ];
      /* Relation dari*/
      public function payment()
      {
          return $this->belongsTo(Payment::class, 'payment_id','payment_id');
      }

}
