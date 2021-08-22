<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Student  $student
     * @return mixed
     */
    public function update(User $user, User $userSubmitted)
    {
        return ($user->isGranted(User::ROLE_STUDENT)
            || $user->isGranted(User::ROLE_ADMINISTRATIVE)
            || $user->isGranted(User::ROLE_COMMISSION)
            || $user->isGranted(User::ROLE_REPRESENTATIVE)
            || $user->isGranted(User::ROLE_TEACHER))
            && ($user->id == $userSubmitted->id) ;
    }
}
