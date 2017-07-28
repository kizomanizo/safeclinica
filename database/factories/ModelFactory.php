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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->randomElement(['Administrator', 'Safe Focus', 'User']),
        'username' => $faker->randomElement(['administrator', 'safefocus', 'user']),
        'password' => $password ?: $password = bcrypt('safefocus'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Http\Models\Treatment::class, function (Faker\Generator $faker) {
    static $user;

    return [
        'name' => $faker->randomElement([
			'Acetaminophen', 'Adderall', 'Alprazolam', 'Amitriptyline', 'Amlodipine', 'Amoxicillin', 'Ativan', 'Atorvastatin', 'Azithromycin', 'Ciprofloxacin', 'Citalopram', 'Clindamycin', 'Clonazepam', 'Codeine', 'Cyclobenzaprine', 'Cymbalta', 'Doxycycline', 'Gabapentin', 'Hydrochlorothiazide', 'Ibuprofen', 'Lexapro', 'Lisinopril', 'Loratadine', 'Lorazepam', 'Losartan', 'Lyrica', 'Meloxicam', 'Metformin', 'Metoprolol', 'Naproxen', 'Omeprazole', 'Oxycodone', 'Pantoprazole', 'Prednisone', 'Tramadol', 'Trazodone', 'Viagra', 'Wellbutrin', 'Xanax', 'Zoloft',
        	]),
        'price' => $faker->randomElement([10, 25, 50, 70, 90, 100, 130, 150, 200, 500, 700, 1000]),
        'user' => $user ?: $user = 'Administrator',
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Http\Models\Investigation::class, function (Faker\Generator $faker) {
    static $user;

    return [
        'name' => $faker->randomElement([
			'Alpha-Fetoprotein (AFP)', 'Amylase', 'Antibody Tests (Coombs Test)', 'Antinuclear Antibodies (ANA)', 'C-Reactive Protein (CRP)', 'Calcium (Ca)', 'Cardiac Enzyme Studies', 'Folic Acid', 'Follicle-Stimulating Hormone', 'HDL Cholesterol', 'Helicobacter pylori', 'Hepatitis Panel', 'Homocysteine', 'Parathyroid Hormone (PTH)', 'Partial Thromboplastin Time', 'Sickle Cell Test', 'Sodium (Na)', 'Stool Analysis', 'Testosterone', 'Thyroid Hormone', 'Thyroid-Stimulating Hormone (TSH)', 'Total Serum Protein', 'Viral Tests', 'Vitamin B12',
        	]),
        'price' => $faker->randomElement([7000, 2400, 3600, 5000, 4500, 1000, 2000, 3000, 20000, 12000, 6000, 15000]),
        'user' => $user ?: $user = 'Administrator',
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Http\Models\Patient::class, function (Faker\Generator $faker) {
    static $user, $status;

    return [
    	'uid' => $faker->regexify('[0-9]{2}[-]{1}[0-9]{2}[-]{1}[0-9]{2}'),
        'name' => $faker->name,
        'age' => $faker->randomNumber(2),
        'sex' => $faker->randomElement(['male', 'female']),
        'village' => $faker->randomElement(['Kongowe', 'Mlandizi', 'Mbuyuni', 'Wajaleo', 'Maendeleo', 'Mnazi', 'Miembe Saba', 'Bondeni', 'Duga', 'Msikitini', 'Kwakombo', 'Kwamfipa', 'Mkoani', 'Visiga', 'Mwendapole', 'Kwa Matiasi']),
        'district_id' => App\Http\Models\District::all()->random()->id,
        'status' => $status ?: $status = 1,
        'user' => $user ?: $user = 'Administrator',
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Http\Models\Patient_insurance::class, function (Faker\Generator $faker) {
    static $user;

    return [
    	'patient_id' => App\Http\Models\Patient::all()->unique()->random()->id,
        'insurance_id' => App\Http\Models\Insurance::all()->random()->id,
        'card' => $faker->optional($weight = 0.1)->regexify('[STGNH]{2}[0-9]{8}'), // 90% chance of NULL
        'user' => $user ?: $user = 'Administrator',
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Http\Models\Patient_investigation::class, function (Faker\Generator $faker) {
    static $user, $status;

    return [
    	'patient_id' => App\Http\Models\Patient::all()->unique()->random()->id,
        'investigation_id' => App\Http\Models\Investigation::all()->random()->id,
        'status' => $status ?: $status = 1, // Set status = 1
        'user' => $user ?: $user = 'Administrator',
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Http\Models\Patient_payment::class, function (Faker\Generator $faker) {
    static $user, $status;

    return [
    	'patient_id' => App\Http\Models\Patient::all()->unique()->random()->id,
        'paid' => $faker->randomElement(['10000', '15000', '20000', '30000']),
        'status' => $status ?: $status = 1, // Set status = 1
        'user' => $user ?: $user = 'Administrator',
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Http\Models\Patient_service::class, function (Faker\Generator $faker) {
    static $user, $status;

    return [
    	'patient_id' => App\Http\Models\Patient::all()->unique()->random()->id,
        'service_id' => App\Http\Models\Service::all()->random()->id,
        'status' => $status ?: $status = 1, // Set status = 1
        'user' => $user ?: $user = 'Administrator',
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Http\Models\Patient_transaction::class, function (Faker\Generator $faker) {
    static $user;

    return [
    	'patient_id' => App\Http\Models\Patient::all()->random()->id,
    	'type' => $faker->randomElement(['service', 'treatment', 'investigation']),
    	'type_id' => $faker->randomElement([1, 2, 3]),
        'type_price' => $faker->randomElement(['3000', '15000', '20000', '13000', '2200', '5700', '8600']),
        'user' => $user ?: $user = 'Administrator',
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Http\Models\Patient_treatment::class, function (Faker\Generator $faker) {
    static $user, $status;

    return [
    	'patient_id' => App\Http\Models\Patient::all()->unique()->random()->id,
    	'treatment_id' => App\Http\Models\Treatment::all()->random()->id,
    	'treatment_tablet' => $faker->numberBetween($min = 1, $max = 20),
        'treatment_payment' => $faker->randomElement(['1000', '5000', '2000', '3000', '1200', '700', '600']),
        'status' => $status ?: $status = 1, // Set status = 1
        'user' => $user ?: $user = 'Administrator',
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});