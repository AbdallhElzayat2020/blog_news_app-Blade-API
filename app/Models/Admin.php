<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
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
