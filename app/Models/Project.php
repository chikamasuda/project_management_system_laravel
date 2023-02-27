<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * 顧客テーブルとのリレーション
     *
     * @return BelongsTo
     */
    public function clients(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
