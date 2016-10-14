<?php

namespace App\Mail;

use App\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Invitation extends Mailable
{
    use Queueable, SerializesModels;

	/**
	 * @var Invite
	 */
	public $invite;

	/**
	 * Create a new message instance.
	 *
	 * @param Invite $invite
	 */
    public function __construct(Invite $invite)
    {
		$this->invite = $invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('invite.email')->subject('Online Awards System Invitation');
    }
}
