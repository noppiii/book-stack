<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Core\Sluggable;
use App\Models\Activity\Loggable;
use Couchbase\Role;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, Loggable, Sluggable
{
    use HasFactory;
    use Authenticatable;
    use CanResetPassword;
    use Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email'
    ];
    protected $casts = ['last_activity_at' => 'datetime'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 'remember_token', 'system_name', 'email_confirmed', 'external_auth_id', 'email',
        'created_at', 'updated_at', 'image_id', 'roles', 'avatar', 'user_id', 'pivot',
    ];

    /**
     * This holds the user's permissions when loaded.
     */
    protected ?Collection $permissions;

    /**
     * This holds the user's avatar URL when loaded to prevent re-calculating within the same request.
     */
    protected string $avatarUrl = '';

    public static function getGuest(): self
    {
        return app()->make('users.default');
    }

    public function isGuest(): bool
    {
        return $this->system_name === 'public';
    }

    public function hasAppAccess(): bool
    {
        return !$this->isGuest() || setting('app-public');
    }

    public function roles()
    {
        if ($this->id === 0) {
            return;
        }
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($roleId): bool
    {
        return $this->roles->pluck('id')->contains($roleId);
    }

    public function hasSystemRole(string $roleSystemName): bool
    {
        return $this->roles->pluck('system_name')->contains($roleSystemName);
    }

    public function attachDefaultRole(): void
    {
        $roleId = intval(setting('registration-role'));
        if ($roleId && $this->roles()->where('id', '=', $roleId)->count() === 0) {
            $this->roles()->attach($roleId);
        }
    }

    public function getAuthIdentifierName()
    {
        // TODO: Implement getAuthIdentifierName() method.
    }

    public function getAuthIdentifier()
    {
        // TODO: Implement getAuthIdentifier() method.
    }

    public function getAuthPassword()
    {
        // TODO: Implement getAuthPassword() method.
    }

    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }

    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }

    public function getEmailForPasswordReset()
    {
        // TODO: Implement getEmailForPasswordReset() method.
    }

    public function sendPasswordResetNotification($token)
    {
        // TODO: Implement sendPasswordResetNotification() method.
    }

    public function logDescriptor(): string
    {
        // TODO: Implement logDescriptor() method.
    }

    public function refreshSlug(): string
    {
        // TODO: Implement refreshSlug() method.
    }
}
