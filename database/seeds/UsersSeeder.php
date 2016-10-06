<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	App\User::create([
		    'name' => 'Test',
		    'email' => 'test@example.com',
		    'password' => bcrypt('test'),
		    'remember_token' => str_random(10),
	    ]);
	    factory(App\User::class, 9)->create();
    }
}
