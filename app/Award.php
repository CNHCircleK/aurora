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
		'deadline',
		'user_id'
	];

	protected static function boot() {
		parent::boot();

		static::creating(function ($model)
		{
			if (Auth::id()) {
				$model->user_id = Auth::id();
			}
		});
	}
}
