<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'project_id',
        'status',
        'content',
        'amount',
        'sales_date',
        'planed_deposit_date',
        'deposit_date'
    ];
}
