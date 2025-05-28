<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
    ];



    /*
    ================================
    Scopes
    ================================
    This section defines the scopes for the contact model.
    */
}
