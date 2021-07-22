<?php

namespace App\Policies;

use App\Company;
use App\Representative;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RepresentativePolicy
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
     * @param Company $company
     * @return mixed
     */
    public function viewAny(User $user, Company $company)
    {
        return $user->isGranted(User::ROLE_ADMINISTRATIVE);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\User $user
     * @param \App\Company $company
     * @param Representative $representative
     * @return mixed
     */
    public function view(User $user, Company $company, Representative $representative)
    {
        return $user->isGranted(User::ROLE_ADMINISTRATIVE);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\User $user
     * @param Company $company
     * @return mixed
     */
    public function create(User $user, Company $company)
    {
        return $user->isGranted(User::ROLE_ADMINISTRATIVE)
            || $user->isGranted(User::ROLE_STUDENT);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param \App\Company $company
     * @param Representative $representative
     * @return mixed
     */
    public function update(User $user, Company $company, Representative $representative)
    {
        return $user->isGranted(User::ROLE_ADMINISTRATIVE);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function delete(User $user, Company $company)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function restore(User $user, Company $company)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function forceDelete(User $user, Company $company)
    {
        //
    }
}
