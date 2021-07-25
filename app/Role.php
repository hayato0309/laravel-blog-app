<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\Permission; "Permission::class" と表記しているので、useでPermission classを使うことを宣言しなくてOK
// use App\User;

class Role extends Model
{
    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getRolesForUser($user)
    {
        $roles = $user->roles->all();

        $roleNames = [];

        foreach ($roles as $role) {
            $roleNames[] = $role->name;
        }

        return $roleNames = collect($roleNames);
    }
}
