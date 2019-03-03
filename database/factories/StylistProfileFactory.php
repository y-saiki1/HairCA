<?php

use Faker\Generator as Faker;

use App\Infrastructures\Entities\Eloquents\EloquentAccounts\EloquentAccount;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'user_id'                  => factory(EloquentAccount::class)->create()->id,
        'base_id'                  => 1,
        'introduction'             => 'おまえは１００％成功しないタイプ…！',
        'birth_date'               => '1994-11-11',
        'sex'                      => 1,
    ];
});
