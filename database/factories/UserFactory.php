<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\studentbio;
use App\staffdetail;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
$factory->define(studentbio::class, function (Faker $faker) {
    return [
        'student_code' => $faker->unique()->randomNumber($nbDigits = null, $strict = false),  // Random task title
        'index_number' =>$faker->unique()->randomNumber($nbDigits = null, $strict = false) , // Random task description
        'adm_no' => $faker->unique()->randomNumber($nbDigits = null, $strict = false),
        'user_id' => $faker->numberBetween($min = 1, $max = 3),
        'Name' => $faker->name,
        'gender' => $faker->randomElement(['male', 'female']),
        'dob' =>$faker->dateTime,
        'village' =>$faker->streetName,
        'gewog' => $faker->city,
        'dzongkhag' => $faker->city,
        'mother_name' => $faker->name,
        'father_name' => $faker->name,
        'father_occupation' =>$faker->jobTitle,
        'mother_occupation' => $faker->jobTitle,
        'guardian_contact' => $faker->phoneNumber,
        'email' =>  $faker->unique()->safeEmail,
        'date_of_joining_school' =>$faker->dateTime,
        'class_when_joining_school' => $faker->numberBetween(6, 13),
        'current_class' => $faker->numberBetween(6, 13),
        'current_section' =>$faker->numberBetween(6, 13),
        'previous_schools' => $faker->text(),
        'hostel_status' => $faker->randomElement(['border', 'dayscholar']),
        'house' => $faker->randomElement(['Tshendhen', 'Drongemtse','Tshergyoen','Jarog']),
        'img_location' => '../images/2020122.JPG',

    ];
});
