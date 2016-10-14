<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Award::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->sentence(3),
		'description' => $faker->paragraph,
		'open' => $faker->dateTimeInInterval('-1 year', '+ 5 days'),
		'deadline' => $faker->dateTimeInInterval('+5 days', '+ 1 year'),
		'user_id' => 1
	];
});

$factory->define(App\Team::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->sentence(2)
	];
});

$factory->define(App\Invite::class, function (Faker\Generator $faker) {
	return [
		'email' => $faker->safeEmail
	];
});

$factory->defineAs(App\Invite::class, 'accepted', function (Faker\Generator $faker) {
	return [
		'email' => $faker->safeEmail,
		'accepted' => $faker->dateTimeInInterval('-1 week', '-1 day')
	];
});