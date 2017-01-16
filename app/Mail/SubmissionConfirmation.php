<?php

namespace App\Mail;

use App\Award;
use App\Submission;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmissionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

	/**
	 * @var \DateTime
	 */
	public $submission_date;

	/**
	 * @var Award
	 */
	public $award;

	/**
	 * Create a new message instance.
	 *
	 * @param $award_id
	 */
    public function __construct($award_id)
    {
        $this->submission_date = Carbon::now();
        $this->award = Award::find($award_id);
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
