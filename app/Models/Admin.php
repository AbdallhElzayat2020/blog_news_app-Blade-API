<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_confirmation',
        'phone',
        'avatar',
        'status',
    ];


    /*
    ================================
    Scopes
    ================================
    This section defines the scopes for the Category model.
    */
}
