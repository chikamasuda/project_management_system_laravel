<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'title',
        'deadline_date',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
