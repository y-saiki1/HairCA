<?php

use Faker\Generator as Faker;

use App\Infrastructures\Entities\Eloquents\EloquentAccounts\EloquentAccount;
use App\Infrastructures\Entities\Eloquents\EloquentHairSalon;

$factory->define(EloquentHairSalon::class, function (Faker $faker) {
    return [
        'user_id'                   => factory(EloquentAccount::class)->create()->id,
        'hair_salon_name'           => '賭博黙示録',
        'hair_salon_postal_code'    => 2702200,
        'hair_salon_prefecture'     => '千葉県',
        'hair_salon_municipality'   => '松戸市',
        'hair_salon_street_number'  => '700',
        'hair_salon_building_name'  => '賭博黙示録',
    ];
});
