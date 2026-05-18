<?php

namespace App\Policies;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MasterDataPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('master.view');
    }

    public function view(User $user, Model $model): bool
    {
        return $user->hasPermissionTo('master.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('master.create');
    }

    public function update(User $user, Model $model): bool
    {
        return $user->hasPermissionTo('master.edit');
    }

    public function delete(User $user, Model $model): bool
    {
        return $user->hasPermissionTo('master.delete');
    }
}