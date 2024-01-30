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

$factory->define(staffdetail::class, function (Faker $faker) {
    return [
        'cid' => $faker->unique()->randomNumber($nbDigits = null, $strict = false),  // Random task title
        'eid' =>$faker->unique()->randomNumber($nbDigits = null, $strict = false) , // Random task description
        'Name' => $faker->name,
        'dob' =>$faker->dateTime,
        'gender' => $faker->randomElement(['male', 'female']),
        'Nationality'=>$faker->randomElement(['Bhutanese', 'Indian','Canadian','American']),
        'grade'=>$faker->optional()->randomElement(['VIII','VII','VI','V','IV','X','XI','XII','XIII','GSP-I','GSP-II','GSC-I','GSC-II','ESP']),
        'position_level'=>$faker->randomElement(['P1A','P2A','P3A','P4A','P5A','S1A','S2A','S3A','S4A','S5A','O1A','O2A','O3A','O4A']),
        'position_title'=>$faker->randomElement(['Principal','Vice Principal','Senior Teacher I','Teacher I','Senior Teacher II','Teacher II','Teacher III','Chief Counselor','Deputy Chief Counselor','Counselor','Sports Instructor','Lab Assitant','Adm Assitant','Lib Assitant','Store Assitant','Warden','Matron','Cook','Sweeper','Caretaker']),
        'contact_number'=>$faker->phoneNumber,
        'Qualification'=> $faker->optional()->randomElement(['Bachelors in Computer Science', 'B.Ed(IT/Chem)','B.Ed(Eng/His)','B.Ed(Geography/Hist)','B.Ed(Bio/Chem)','B.sc Physical Science,Pgde(Physics)','B.sc Life Science,Pgde(Bio)','B.Ed(Bio/Chem),M.Sc(Horticulture)','BTech,PgDE(ite),MCA','B.Ed(Eng/His),M.Ed(English Communication)','B.Com/PgDE(Accounts)','B.Com/PgDE(Commerce)','B.Com/PgDE(Economics)/ME(Master in economics)']),
        'subject_specilization'=>$faker->optional()->randomElement(['English','History','Geogrpahy','Computer','Math','Integrated Science','Dzongkha','Accounts','Commerce','Biology','Physics','Chemistry','EVS','Media Studies']),
        'date_of_appointment'=>$faker->dateTime,
        'village' =>$faker->streetName,
        'gewog' => $faker->city,
        'dzongkhag' => $faker->randomElement(['Thimphu', 'Wangduephodrang','Sarpang','Samtse','Pemagathsel','Punakha','Samdrupjongkhar','Tsirang','Gasa','Chhukha','Zhemgang','Trongsa','Bumthang','Mongar','Trashigang','Trashiyangtse','Haa','Paro']),
        'email' =>  $faker->unique()->safeEmail,
        'previous_schools_served' => $faker->text(),
        'user_id_of_updater'=>$faker->numberBetween($min = 1, $max = 3),
        'img_location' => '2020122.JPG',

    ];
});
