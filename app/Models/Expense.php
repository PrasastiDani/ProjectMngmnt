<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'expenses'; 
    protected $primaryKey = 'expense_id';
    /**
     * fillable
     *
     * @var array
     */

    protected $fillable = [
        'amount',
        'category',
        'date',
        'source',
        'description',
    ];
}
