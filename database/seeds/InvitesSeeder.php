<?php

use Illuminate\Database\Seeder;

class InvitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    factory(App\Invite::class, 10)->create();
	    factory(App\Invite::class, 'accepted', 10)->create();
    }
}
