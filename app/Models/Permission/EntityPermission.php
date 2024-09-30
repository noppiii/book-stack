<?php

namespace App\Models\Permission;

use App\Models\User\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntityPermission extends Model
{
    public const PERMISSIONS = ['view', 'create', 'update', 'delete'];

    protected $fillable = ['role_id', 'view', 'create', 'update', 'delete'];
    public $timestamps = false;
    protected $hidden= ['entity_id', 'entity_type', 'id'];
    protected $casts = [
        'view' => 'boolean',
        'create' => 'boolean',
        'read' => 'boolean',
        'update' => 'boolean',
        'delete' => 'boolean',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
