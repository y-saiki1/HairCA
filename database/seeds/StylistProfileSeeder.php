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
            'introduction'             => 'おまえは１００％成功しないタイプ…！',
            'recommendation'           => '所詮お前は　指示待ち人間っ・・・・！',
            'hair_salon_name'          => '賭博黙示録',
            'hair_salon_postal_code'   => 2702200,
            'hair_salon_prefecture'    => '千葉県',
            'hair_salon_municipality'  => '松戸市',
            'hair_salon_street_number' => '700',
            'hair_salon_building_name' => '賭博黙示録',
        ]);

        $stylistProfile->create([
            'user_id'                  => 2,
            'recommender_id'           => 1,
            'age'                      => 35,
            'sex'                      => 1,
            'introduction'             => 'おまえの毎日って今ゴミって感じだろ？　無気力で自堕落で非生産＞どうしておまえが今そうなのかわかるか？＞金を掴んでないからだ＞金を掴んでないから毎日がリアルじゃねえんだよ頭にカスミがかかってんだ',
            'recommendation'           => '一生迷ってろ…！そして失い続けるんだ…貴重な機会(チャンス)をっ！',
            'hair_salon_name'          => '賭博黙示録',
            'hair_salon_postal_code'   => 2702200,
            'hair_salon_prefecture'    => '千葉県',
            'hair_salon_municipality'  => '松戸市',
            'hair_salon_street_number' => '700',
            'hair_salon_building_name' => '賭博黙示録',
        ]);
    }
}
