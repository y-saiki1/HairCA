<?php

use Illuminate\Database\Seeder;

use App\Infrastructures\Entities\Eloquents\EloquentStylistProfile;

class StylistProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(EloquentStylistProfile $stylistProfile)
    {
        $stylistProfile->create([
            'user_id'                  => 1,
            'recommender_id'           => 2,
            'age'                      => 21,
            'sex'                      => 1,
            'introduction'             => '所詮お前は　指示待ち人間っ・・・・！',
            'recommendation'           => 'おまえは１００％成功しないタイプ…！',
            'hair_salon_name'          => 'カイジ',
            'hair_salon_postal_code'   => 2702200,
            'hair_salon_prefecture'    => '千葉県',
            'hair_salon_municipality'  => '松戸市',
            'hair_salon_street_number' => '700',
            'hair_salon_building_name' => 'カイジ',
        ]);

        $stylistProfile->create([
            'user_id'                  => 2,
            'recommender_id'           => 1,
            'age'                      => 35,
            'sex'                      => 1,
            'introduction'             => '一生迷ってろ…！そして失い続けるんだ…貴重な機会(チャンス)をっ！',
            'recommendation'           => '明日からがんばるんじゃない…今日…今日だけがんばるんだっ…！今日をがんばった者…今日をがんばり始めた者にのみ…明日が来るんだよ…！',
            'hair_salon_name'          => 'カイジ',
            'hair_salon_postal_code'   => 2702200,
            'hair_salon_prefecture'    => '千葉県',
            'hair_salon_municipality'  => '松戸市',
            'hair_salon_street_number' => '700',
            'hair_salon_building_name' => 'カイジ',
        ]);
    }
}
