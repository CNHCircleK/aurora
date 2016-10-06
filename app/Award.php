<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Award extends Model {
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description',
		'open',
		'deadline'
	];

	public function __construct( array $attributes ) {
		$this->setRawAttributes( [
			'user_id' => Auth::id()
		] );
		parent::__construct( $attributes );
	}
}
