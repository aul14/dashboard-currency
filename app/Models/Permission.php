<?php

namespace App\Models;

use App\Models\Module;
use App\Models\PermissionRole;
use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function permission_role()
    {
        return $this->hasMany(PermissionRole::class);
    }

    public function permission_with_role($permission_id, $role_id)
    {
        return PermissionRole::where('permission_id', $permission_id)
            ->where('role_id', $role_id)->first();
    }
}
