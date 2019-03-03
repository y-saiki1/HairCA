<?php

use Faker\Generator as Faker;

use App\Infrastructures\Entities\Eloquents\EloquentAccounts\EloquentAccount;
use App\Infrastructures\Entities\Eloquents\Recommender;

$factory->define(Recommender::class, function (Faker $faker) {
    return [
        'user_id'                  => factory(EloquentAccount::class)->create()->id,
        'recommender_id'           => factory(EloquentAccount::class)->create()->id,
        'recommendation'           => '所詮お前は　指示待ち人間っ・・・・！',
    ];
});
