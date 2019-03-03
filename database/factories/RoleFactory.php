<?php

use Faker\Generator as Faker;

use App\Infrastructures\Entities\Eloquents;

$factory->define(EloquentRole::class, function (Faker $faker) {
    return [
        'name' => 'stylist'
    ];
});
