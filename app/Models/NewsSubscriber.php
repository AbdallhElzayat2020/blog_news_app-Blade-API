<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsSubscriber extends Model
{
    protected $fillable = ['email'];

    protected $table = 'news_subscribers';
}
