<?php

namespace App\Mail;

use App\Award;
use App\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmissionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

	/**
	 * @var Submission
	 */
	public $submission;

	/**
	 * @var Award
	 */
	public $award;

	/**
	 * Create a new message instance.
	 *
	 * @param Submission $submission
	 */
    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
        $this->award = $submission->award;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('award.emails.confirmation')
	        ->subject('Awards Application Submission Confirmation - ' . $this->award->name);
    }
}
