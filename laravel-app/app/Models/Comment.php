<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'post_id',
        'text',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
