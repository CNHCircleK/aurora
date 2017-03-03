<?php

namespace App\Http\Controllers;

use App\Award;
use App\Submission;
use App\Team;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Storage;
use Chumper\Zipper\Zipper;

class AwardController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$awards = Award::all();

		return view( 'award/index', compact( 'awards' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$this->authorize('create', Award::class);
		return view('award/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$this->authorize('create', Award::class);
		$award = Award::create($request->all());
		return redirect()->action('AwardController@show', $award->slug);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param $slug
	 *
	 * @return \Illuminate\Http\Response
	 * @internal param int $id
	 */
	public function show( $slug ) {
		$award = Award::findBySlug( $slug );
		$submissions = Submission::where('user_id', Auth::id())->where('award_id', $award->id)->get();

		return view( 'award/show', compact( 'award', 'submissions' ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $slug
	 *
	 * @return \Illuminate\Http\Response
	 * @internal param int $id
	 */
	public function edit( $slug ) {
		$award = Award::findBySlug( $slug );
		$this->authorize('update', $award);

		return view( 'award/edit', compact( 'award' ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param $slug
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function update( Request $request, $slug ) {

		$award = Award::findBySlug( $slug );
		$this->authorize('update', $award);
		$award->update($request->all());
		return redirect()->action('AwardController@show', $slug);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}

	public function getAllFiles(Zipper $zipper) {
		$filename = Carbon::now()->format('Y_m_d_His') . '_AwardsFiles.zip';

		$awards = Submission::all()->groupBy('award_id');

		foreach ($awards as $award_id => $award_submissions) {
			// Get award name
			$award_name = Award::find($award_id)->name;

			// Break down by schools
			foreach ($award_submissions->groupBy('team_id') as $team_id => $team_submissions) {
				// Get school name
				$team_name = Team::find($team_id)->name;

				foreach ($team_submissions as $submission) {
					Storage::put('temp/awardsBundle/' .
					             $filename . '/' .
					             $award_name . '/' . $team_name . '/' . $submission->orig_filename,
						Storage::disk('public')->get($submission->file));
				}
			};
		}

		$zipfile = $zipper->make(storage_path('app/public/awardsBundles/' . $filename ))
		                  ->add(storage_path('app/temp/awardsBundle/' . $filename ));

		$filepath = $zipfile->getFilePath();

		$zipfile->close();

		// Clean up
		Storage::deleteDirectory('temp/awardsBundle/' . $filename);

		return Storage::url('awardsBundles/' . $filename);
	}
}
