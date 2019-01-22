<?php

use Illuminate\Database\Seeder;

use App\Infrastructures\Entities\Eloquents\EloquentStylistProfile;
use App\Infrastructures\Entities\Eloquents\EloquentHairSalon;
use App\Infrastructures\Entities\Eloquents\EloquentRecommender;

class StylistProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(EloquentStylistProfile $stylistProfile, EloquentHairSalon $hairSalon, EloquentRecommender $recommender)
    {
        // 伊藤カイジ
        $stylistProfile->create([
            'user_id'                  => 1,
            'introduction'             => 'おまえは１００％成功しないタイプ…！',
            'birth_date'               => '1994-11-11',
            'sex'                      => 1,
        ]);
        $hairSalon->create([
            'user_id'                  => 1,
            'hair_salon_name'          => '賭博黙示録',
            'hair_salon_postal_code'   => 2702200,
            'hair_salon_prefecture'    => '千葉県',
            'hair_salon_municipality'  => '松戸市',
            'hair_salon_street_number' => '700',
            'hair_salon_building_name' => '賭博黙示録',
        ]);
        $recommender->create([
            'user_id'                  => 1,
            'recommender_id'           => 2,
            'recommendation'           => '所詮お前は　指示待ち人間っ・・・・！',
        ]);

        // 遠藤さん
        $stylistProfile->create([
            'user_id'                  => 2,
            'introduction'             => 'おまえの毎日って今ゴミって感じだろ？　無気力で自堕落で非生産＞どうしておまえが今そうなのかわかるか？＞金を掴んでないからだ＞金を掴んでないから毎日がリアルじゃねえんだよ頭にカスミがかかってんだ',
            'birth_date'               => '1994-11-11',
            'sex'                      => 1,
        ]);
        $hairSalon->create([
            'user_id'                  => 2,
            'hair_salon_name'          => '賭博黙示録',
            'hair_salon_postal_code'   => 2702200,
            'hair_salon_prefecture'    => '千葉県',
            'hair_salon_municipality'  => '松戸市',
            'hair_salon_street_number' => '700',
            'hair_salon_building_name' => '賭博黙示録',
        ]);
        $recommender->create([
            'user_id'                  => 2,
            'recommender_id'           => 1,
            'recommendation'           => '一生迷ってろ…！そして失い続けるんだ…貴重な機会(チャンス)をっ！',
        ]);
    }
}
