<?php

namespace App\Policies;

use App\User;
use App\Invite;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitePolicy
{
    use HandlesAuthorization;

	/**
	 * Determines whether the user can view all invites.
	 *
	 * @param User $user
	 * @return mixed
	 */
	public function viewAll(User $user)
	{
		return $user->admin;
	}

    /**
     * Determine whether the user can create invites.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->admin;
    }
}
