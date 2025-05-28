<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'alt_text',
        'path',
        'post_id',
    ];

    /**
     * Get the parent imageable model (Post, Category, etc.)
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
