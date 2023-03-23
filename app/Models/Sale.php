<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'planned_deposit_date',
        'deposit_date'
    ];

    /**
     * 案件テーブルとのリレーション
     *
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
