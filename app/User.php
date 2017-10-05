<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name', 'orderManager', 'accessLevel', 'location_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'first_name', 'last_name', 'orderManager', 'accessLevel', 'login', 'created_at', 'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($roles)
    {
        if(is_string($roles)) {
            return $this->roles->contains('name', $roles);
        }
        return (boolean) $roles->intersect($this->roles)->count();
    }

    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::where('name', $role)->firstOrFail()
        );
    }

    public function hasPermission($permissions)
    {
        $permissions = is_array($permissions) ? $permissions: [$permissions];
        $uPermissions = collect(data_get($this, 'roles.*.permissions.*.name'));
        return (boolean) collect($permissions)->intersect($uPermissions)->count();
    }

}
