<?php

use Illuminate\Database\Seeder;

/**
 * Class TeamsSeeder
 *
 * Create teams and owners
 */
class TeamsSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(App\User::class, 9)->create()->each(function($u) {
			$u->team()->save(factory(App\Team::class)->make());
		});
	}
}
