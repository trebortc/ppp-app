<?php

namespace App\Policies;

use App\Internship;
use App\Teacher;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class InternshipPolicy
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
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user !== null;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\User $user
     * @param \App\Internship $internship
     * @return mixed
     */
    public function view(User $user, Internship $internship)
    {
        return $user->isGranted(User::ROLE_ADMINISTRATIVE) || $user->isGranted(User::ROLE_COMMISSION)
            || (isset($internship->representative) && $user->id == $internship->representative->user->id)
            || (isset($internship->student) && $user->id == $internship->student->user->id)
            || (isset($internship->teacher) && $user->id == $internship->teacher->user->id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_STUDENT);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param \App\Internship $internship
     * @return mixed
     */
    public function update(User $user, Internship $internship)
    {
        return $user->isGranted(User::ROLE_STUDENT)
            && $user->id == $internship->student->user->id
            && $internship->status === 'pending';
    }

    /**
     * Determine whether the user can assign a teacher to the internship.
     *
     * @param \App\User $user
     * @param \App\Internship $internship
     * @return mixed
     */
    public function assignTeacher(User $user, Internship $internship)
    {
        // solo un ROLE_ADMINISTRATIVE puede asignar o editar un tutor
        // mientras no esté en uno de los estados indicados
        return $user->isGranted(User::ROLE_ADMINISTRATIVE)
            && !in_array($internship->status, ['rejected', 'commission_pending', 'approved', 'registered']);
    }

    /**
     * Determine whether the user can set the student section of the report.
     *
     * @param \App\User $user
     * @param \App\Internship $internship
     * @return mixed
     */
    public function setStudentSection(User $user, Internship $internship)
    {
        return $user->isGranted(User::ROLE_STUDENT)
            && $user->id == $internship->student->user->id
            && ($internship->status === 'in_progress' || $internship->status === 'representative_pending');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param Internship $internship
     * @return mixed
     */
    public function setRepresentativeSection(User $user, Internship $internship)
    {
        return (
            $user->isGranted(User::ROLE_REPRESENTATIVE)
            && $user->id == $internship->representative->user->id
            && $internship->status === 'representative_pending'
        );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param Internship $internship
     * @return mixed
     */
    public function setTutorSection(User $user, Internship $internship)
    {
        return (
            $user->isGranted(User::ROLE_TEACHER)
            && isset($internship->teacher)
            && $user->id == $internship->teacher->user->id
            && $internship->status === 'tutor_pending'
        );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param Internship $internship
     * @return mixed
     */
    public function setCommissionSection(User $user, Internship $internship)
    {
        return (
            $user->isGranted(User::ROLE_COMMISSION)
            && $internship->status === 'commission_pending'
        );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param Internship $internship
     * @return mixed
     */
    public function registerInternship(User $user, Internship $internship)
    {
        return (
            $user->isGranted(User::ROLE_ADMINISTRATIVE)
            && $internship->status === 'approved'
        );
    }

//    /**
//     * Determine whether the user can authorize the model.
//     *
//     * @param \App\User $user
//     * @param \App\Internship $internship
//     * @return mixed
//     */
//    public function authorization(User $user, Internship $internship)
//    {
//        return $user->isGranted(User::ROLE_ADMINISTRATIVE) &&
//            $internship->status == 'pending_authorization';
//    }


    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\User $user
     * @param \App\Internship $internship
     * @return mixed
     */
    public function delete(User $user, Internship $internship)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\User $user
     * @param \App\Internship $internship
     * @return mixed
     */
    public function restore(User $user, Internship $internship)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\User $user
     * @param \App\Internship $internship
     * @return mixed
     */
    public function forceDelete(User $user, Internship $internship)
    {
        return false;
    }
}
