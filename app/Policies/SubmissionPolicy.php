<?php

namespace App\Policies;

use App\User;
use App\Submission;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubmissionPolicy
{
    use HandlesAuthorization;

	/**
	 * Determine whether user has access to all submissions
	 *
	 * @param User $user
	 * @return mixed
	 */
	public function viewAll(User $user)
	{
		return $user->admin;
	}

    /**
     * Determine whether the user can view the submission.
     *
     * @param  User  $user
     * @param  Submission  $submission
     * @return mixed
     */
    public function view(User $user, Submission $submission)
    {
        return $user->admin || $user->id === $submission->user->id;
    }

    /**
     * Determine whether the user can update the submission.
     *
     * @param  User  $user
     * @param  Submission  $submission
     * @return mixed
     */
    public function update(User $user, Submission $submission)
    {
        return $user->id === $submission->user->id;
    }

    /**
     * Determine whether the user can delete the submission.
     *
     * @param  User  $user
     * @param  Submission  $submission
     * @return mixed
     */
    public function delete(User $user, Submission $submission)
    {
        return $user->admin || $user->id === $submission->user->id;
    }
}
