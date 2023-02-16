<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'status',
        'name',
        'start_date',
        'end_date',
        'image_url',
        'content',
    ];

    public function clients()
    {
        return $this->belongsTo(Client::class);
    }
}
