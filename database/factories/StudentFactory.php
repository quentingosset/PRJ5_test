<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Student;
use Faker\Generator as Faker;


$factory->define(Student::class, function (Faker $faker) {
    return [
        "matricule" => $faker->randomNumber(5),
        "groupe" => 1,
        "nom" => $faker->firstname,
        "prenom" =>$faker->lastname,
    ];
});


