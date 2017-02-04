<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'email',
		'token'
	];

	protected $dates = [
		'created_at',
		'updated_at',
		'accepted',
	];

	protected static function boot() {
		parent::boot();

		static::creating(function ($model)
		{
			if (!isset($model->token)) {
				$model->token = str_random();
			}
		});
	}
}
