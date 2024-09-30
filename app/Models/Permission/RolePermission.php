<?php

namespace App\Models\Permission;

use App\Models\User\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RolePermission extends Model
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }

    protected static function getByName(string $name): ?RolePermission
    {
        return static::where('name', '=', $name)->first();
    }
}
