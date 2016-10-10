<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'owner_id'
	];

	protected static function boot() {
		parent::boot();

		static::creating(function ($model)
		{
			if (Auth::id()) {
				$model->owner_id = Auth::id();
			}
		});
	}

	public function owner()
	{
		return $this->belongsTo('App\User', 'owner_id');
	}
}
