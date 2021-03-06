<?php

namespace App\Http\Controllers;

use App\Award;
use App\Mail\SubmissionConfirmation;
use App\Submission;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\UploadedFile;
use Mail;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
	public function store( Request $request ) {
		$this->validate($request, [
			'files.*' => 'required|file|mimes:pdf'
		], [
			'mimes' => 'Submissions must be in PDF format.'
		]);

		$award_id = $request->input('award_id');

		// Check if award is open
		if (Award::find($award_id)->isClosed()) {
			return redirect()->back()->withErrors(['award.closed' => 'This award is not open for submission!']);
		}

		foreach($request->file('files') as $file) {
			$this->_processSubmission($award_id, $file);
		}

		// Send confirmation email
		$email = Auth::user()->email;

		Mail::to($email)->send(new SubmissionConfirmation($award_id));

		return redirect()->back();
	}

	/**
	 * Processes submission
	 *
	 * Stores and creates files
	 *
	 * @param $award_id
	 * @param UploadedFile $file
	 */
	private function _processSubmission($award_id, UploadedFile $file) {
		$path = $file->store('submissions', 'public');

		Submission::create([
			'file' => $path,
			'orig_filename' => $file->getClientOriginalName(),
			'award_id' => $award_id,
			'user_id' => Auth::id(),
			'team_id' => Auth::user()->team->id
		]);
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$object = Submission::find($id);

	    // Check if award is open
	    if ($object->award->isClosed()) {
		    return redirect()->back()
			    ->withErrors(['award.closed' => 'This submission is not able to be modified at this time!']);
	    }

	    $this->authorize('delete', $object);

	    if ($object->delete()) {
	        return redirect()->back()->with('message', 'Successfully deleted!');
	    }
	    else {
	    	return redirect()->back()->with('error-message', 'Could not delete!');
	    }
    }
}
