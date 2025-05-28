<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{


    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'status',
    ];



    /*
    ===============================
    Relationships
    ===============================
    This section defines the relationships between the Category model and other models.
    */

    /**
     * Get all of the comments for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'post_id', 'id');
    }


    /*
    ================================
    Scopes
    ================================
    This section defines the scopes for the Category model.
    */
}
