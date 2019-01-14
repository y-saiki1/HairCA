<?php

use Illuminate\Database\Seeder;

use App\Infrastructures\Entities\Eloquents\EloquentUser;
use Illuminate\Contracts\Hashing\Hasher;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(EloquentUser $user, Hasher $hasher)
    {
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
    }
}
