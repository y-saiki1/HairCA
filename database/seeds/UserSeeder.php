<?php

use Illuminate\Database\Seeder;

use App\Infrastructures\Entities\Eloquents\EloquentUser;
use App\Infrastructures\Entities\Eloquents\EloquentRole;
use App\Infrastructures\Entities\Eloquents\EloquentStylistProfile;
use App\Infrastructures\Entities\Eloquents\EloquentHairSalon;
use App\Infrastructures\Entities\Eloquents\EloquentRecommender;
use App\Infrastructures\Entities\Eloquents\EloquentBase;
use Illuminate\Contracts\Hashing\Hasher;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(
        EloquentRole $role,
        EloquentUser $user,
        EloquentStylistProfile $stylistProfile,
        EloquentHairSalon $hairSalon,
        EloquentRecommender $recommender,
        EloquentBase $base,
        Hasher $hasher
    ) {
        $role1 = $role->create(
            ['name' => 'stylist']
        );

        $role2 = $role->create(
            ['name' => 'member']
        );

        $base1 = $base->insert([
            ['name' => '北海道'],
            ['name' => '青森'],
            ['name' => '岩手'],
            ['name' => '宮城'],
            ['name' => '秋田'],
            ['name' => '山形'],
            ['name' => '福島'],
            ['name' => '茨城'],
            ['name' => '栃木'],
            ['name' => '群馬'],
            ['name' => '埼玉'],
            ['name' => '千葉'],
            ['name' => '東京'],
            ['name' => '神奈川'],
            ['name' => '新潟'],
            ['name' => '富山'],
            ['name' => '石川'],
            ['name' => '福井'],
            ['name' => '山梨'],
            ['name' => '長野'],
            ['name' => '岐阜'],
            ['name' => '静岡'],
            ['name' => '愛知'],
            ['name' => '三重'],
            ['name' => '滋賀'],
            ['name' => '京都'],
            ['name' => '大阪'],
            ['name' => '兵庫'],
            ['name' => '奈良'],
            ['name' => '和歌山'],
            ['name' => '鳥取'],
            ['name' => '島根'],
            ['name' => '岡山'],
            ['name' => '広島'],
            ['name' => '山口'],
            ['name' => '徳島'],
            ['name' => '香川'],
            ['name' => '愛媛'],
            ['name' => '高知'],
            ['name' => '福岡'],
            ['name' => '佐賀'],
            ['name' => '長崎'],
            ['name' => '熊本'],
            ['name' => '大分'],
            ['name' => '宮崎'],
            ['name' => '鹿児島'],
            ['name' => '沖縄']
        ]);

        $user->create([
            'role_id'   => 1,
            'name'      => '伊藤カイジ',
            'email'     => 'kaiji@ore.com',
            'password'  => $hasher->make('password'),
        ]);

        $user->create([
            'role_id'   => 1,
            'name'      => '遠藤勇次',
            'email'     => 'endou@ore.com',
            'password'  => $hasher->make('password'),
        ]);

        // 伊藤カイジ
        $stylistProfile->create([
            'user_id'                  => 1,
            'base_id'                  => 1,
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
            'base_id'                  => 1,
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
