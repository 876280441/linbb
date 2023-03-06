<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $currentUser '当前登录用户'
     * @param User $user '路由使用用户'
     */
//    public function __construct(User $currentUser, User $user)
//    {
//        return $currentUser->id === $user->id;
//    }
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}
