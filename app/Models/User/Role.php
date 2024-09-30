<?php

namespace App\Models\User;

use App\Models\Activity\Loggable;
use App\Models\JointPermission;
use App\Models\Permission\EntityPermission;
use App\Models\Permission\RolePermission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model implements Loggable
{

    use HasFactory;

    protected $fillable = ['display_name', 'description', 'external_auth_id', 'mfa_enforced'];
    protected $hidden = ['pivot'];
    protected $casts = [
        'mfa_enforced' => 'boolean'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->orderBy('name', 'asc');
    }

    public function jointPermissions(): HasMany
    {
        return $this->hasMany(JointPermission::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(RolePermission::class, 'permission_role', 'role_id', 'permission_id');
    }

    public function entityPermissions(): HasMany
    {
        return $this->hasMany(EntityPermission::class);
    }

    public function hasPermission(string $permissionName): bool
    {
        $permissions = $this->getRelationValue('permissions');
        foreach ($permissions as $permission) {
            if ($permission->getRawAttribute('name') === $permissionName) {
                return true;
            }
        }
        return false;
    }

    public function attachPermission(RolePermission $permission)
    {
        $this->permissions()->attach($permission->id);
    }

    public function detachPermission(RolePermission $permission)
    {
        $this->permissions()->detach([$permission->id]);
    }

    public static function getRole(string $displayName): ?self
    {
        return static::query()->where('display_name', '=', $displayName)->first();
    }

    public static function getSystemRole(string $systemName): ?self
    {
        static $cache = [];

        if (!isset($cache[$systemName])) {
            $cache[$systemName] = static::query()->where('system_name', '=', $systemName)->first();
        }
        return $cache[$systemName];
    }

    public function logDescriptor(): string
    {
        return "({$this->id}) {$this->display_name}";
    }
}
