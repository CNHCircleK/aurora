<?php

namespace App;

use Auth;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Award extends Model {

	use Sluggable, SluggableScopeHelpers;

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

	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable()
	{
		return [
			'slug' => [
				'source' => 'name'
			]
		];
	}

	public function submissions()
	{
		return $this->hasMany('App\Submission');
	}

	public function setOpenAttribute($open)
	{
		$this->attributes['open'] = Carbon::parse($open);
	}

	public function setDeadlineAttribute($deadline)
	{
		$this->attributes['deadline'] = Carbon::parse($deadline);
	}
}
