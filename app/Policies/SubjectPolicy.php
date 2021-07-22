<?php

namespace App\Policies;

use App\Subject;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
{
    use HandlesAuthorization;

    /**
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if ($user->isGranted(User::ROLE_SUPERADMIN)) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isGranted(User::ROLE_ADMINISTRATIVE);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Subject  $subject
     * @return mixed
     */
    public function view(User $user, Subject $subject)
    {
        return $user->isGranted(User::ROLE_ADMINISTRATIVE);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_ADMINISTRATIVE);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Subject  $subject
     * @return mixed
     */
    public function update(User $user, Subject $subject)
    {
        return $user->isGranted(User::ROLE_ADMINISTRATIVE);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Subject  $Subject
     * @return mixedx
     */
    public function restore(User $user, Subject $subject)
    {
        return $user->isGranted(User::ROLE_ADMINISTRATIVE);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Subject  $subject
     * @return mixed
     */
    public function disable(User $user, Subject $subject)
    {
        return $user->isGranted(User::ROLE_ADMINISTRATIVE);
    }

}
