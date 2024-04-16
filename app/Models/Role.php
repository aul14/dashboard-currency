<?php

namespace App\Models;

use App\Models\PermissionRole;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public function permission_role()
    {
        return $this->hasMany(PermissionRole::class);
    }
}
