<?php

namespace App\Policies;

use App\User;
use App\Award;
use Illuminate\Auth\Access\HandlesAuthorization;

class AwardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create awards.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->admin;
    }

    /**
     * Determine whether the user can update the award.
     *
     * @param  User  $user
     * @param  Award  $award
     * @return mixed
     */
    public function update(User $user, Award $award)
    {
	    return $user->admin;
    }

    /**
     * Determine whether the user can delete the award.
     *
     * @param  User  $user
     * @param  Award  $award
     * @return mixed
     */
    public function delete(User $user, Award $award)
    {
	    return $user->admin;
    }
}
