<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monthly_Report extends Model
{
    use HasFactory;
    protected $table = 'monthly__reports'; 
    protected $primaryKey = 'report_id';

    /**
     * fillable
     *
     * @var array
     */

    protected $fillable = [
        'month',
        'year',
        'total_income',
        'net_profit',
    ];
}
