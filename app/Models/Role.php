<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = [
        'role_name',
        'status',
        'permissions',
    ];

    protected $table = 'roles';


    public function admins(): HasMany
    {
        return $this->hasMany(Admin::class);
    }

    // Accessor to decode JSON permissions
    public function getPermissionsAttribute($permissions)
    {
        return json_decode($permissions, true);
    }
}
