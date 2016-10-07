<?php

namespace App\Http\Controllers;

use App\Award;
use App\Submission;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

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
		$submissions = Submission::where('user_id', Auth::id())->get();

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
}
