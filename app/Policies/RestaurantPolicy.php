<?php

namespace App\Policies;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RestaurantPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isSuperAdmin() || $user->isAdmin();
    }

    public function view(User $user, Restaurant $restaurant)
    {
        return $user->isSuperAdmin() || $restaurant->user_id === $user->id;
    }

    public function create(User $user)
    {
        return $user->isSuperAdmin() || $user->isAdmin();
    }

    // public function update(User $user, Restaurant $restaurant)
    // {
    //     return $user->isSuperAdmin() || $restaurant->user_id === $user->id;
    // }

    // public function delete(User $user, Restaurant $restaurant)
    // {
    //     return $user->isSuperAdmin() || $restaurant->user_id === $user->id;
    // }

    // app/Policies/RestaurantPolicy.php
    public function update(User $user, Restaurant $restaurant)
    {
        return $user->id === $restaurant->user_id || $user->isSuperAdmin();
    }

    public function delete(User $user, Restaurant $restaurant)
    {
        return $user->id === $restaurant->user_id || $user->isSuperAdmin();
    }
// these are extra

    public function restore(User $user, Restaurant $restaurant)
    {
        return $user->isSuperAdmin() || $restaurant->user_id === $user->id;
    }

    public function forceDelete(User $user, Restaurant $restaurant)
    {
        return $user->isSuperAdmin() || $restaurant->user_id === $user->id;
    }
}