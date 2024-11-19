<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $table = 'assets'; 
    protected $primaryKey = 'asset_id';
    /**
     * fillable
     *
     * @var array
     */

    protected $fillable = [
        'asset_name',
        'category',
        'purchase_cost',
        'purchase_date',
        'status',
        'description',
    ];
}
