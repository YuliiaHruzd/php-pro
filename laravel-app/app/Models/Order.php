<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'total',
        'tax',
        'subtotal',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
