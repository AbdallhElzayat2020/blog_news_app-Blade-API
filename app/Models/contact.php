<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{

    use HasFactory;
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
