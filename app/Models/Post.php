<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{

    use Sluggable, HasFactory;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    protected $fillable = [
        'user_id',
        'category_id',
        'number_of_views',
        'comment_able',
        'status',
        'description',
        'slug',
        'title',
    ];


    /*
    ===============================
    Relationships
    ===============================
    This section defines the relationships between the Post model and other models.
    */

    /**
     * Get all of the comments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the comments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all of the comments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'post_id');
    }

    /*
    * Admin
    */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }


    /**
     * ===================================
     * Scope to filter active posts & User & Category
     * ===================================
     */

    #[Scope]
    protected function active(Builder $query): Builder
    {
        return $query->whereStatus('active');
    }

    #[Scope]
    protected function activeUser(Builder $query): Builder
    {
        return $query->where(function (Builder $query) {
            $query->whereHas('user', function ($user) {
                $user->whereStatus('active');
            })->orWhere('user_id', null);
        });
    }

    #[Scope]
    protected function activeCategory(Builder $query): Builder
    {
        return $query->whereHas('category', function ($category) {
            $category->whereStatus('active');
        });
    }
}
