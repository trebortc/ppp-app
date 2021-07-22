<?php

namespace App\Policies;

use App\Followup;
use App\Internship;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FollowupPolicy
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
     * @param \App\User $user
     * @param Internship $internship
     * @return mixed
     */
    public function viewAny(User $user, Internship $internship)
    {
        return $user->isGranted(User::ROLE_ADMINISTRATIVE) || $user->isGranted(User::ROLE_COMMISSION)
            || (isset($internship->representative) && $user->id == $internship->representative->user->id)
            || (isset($internship->student) && $user->id == $internship->student->user->id)
            || (isset($internship->teacher) && $user->id == $internship->teacher->user->id);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Followup  $followup
     * @return mixed
     */
    public function view(User $user, Followup $followup)
    {
        return false; // no es necesario ver uno especifico
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\User $user
     * @param Internship $internship
     * @return mixed
     */
    public function create(User $user, Internship $internship)
    {
        return $user->isGranted(User::ROLE_COMMISSION)
            || (isset($internship->representative) && $user->id == $internship->representative->user->id)
            || (isset($internship->student) && $user->id == $internship->student->user->id)
            || (isset($internship->teacher) && $user->id == $internship->teacher->user->id);
    }

//    /**
//     * Determine whether the user can update the model.
//     *
//     * @param  \App\User  $user
//     * @param  \App\Followup  $followup
//     * @return mixed
//     */
//    public function update(User $user, Followup $followup)
//    {
//        //
//    }
//
//    /**
//     * Determine whether the user can delete the model.
//     *
//     * @param  \App\User  $user
//     * @param  \App\Followup  $followup
//     * @return mixed
//     */
//    public function delete(User $user, Followup $followup)
//    {
//        //
//    }
//
//    /**
//     * Determine whether the user can restore the model.
//     *
//     * @param  \App\User  $user
//     * @param  \App\Followup  $followup
//     * @return mixed
//     */
//    public function restore(User $user, Followup $followup)
//    {
//        //
//    }
//
//    /**
//     * Determine whether the user can permanently delete the model.
//     *
//     * @param  \App\User  $user
//     * @param  \App\Followup  $followup
//     * @return mixed
//     */
//    public function forceDelete(User $user, Followup $followup)
//    {
//        //
//    }
}
