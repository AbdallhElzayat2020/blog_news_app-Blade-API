<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedSite extends Model
{
    protected $fillable = [
        'name',
        'url'
    ];

    protected $table = 'related_sites';
}
