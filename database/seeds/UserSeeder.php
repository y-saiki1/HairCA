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
            'name'      => 'ore',
            'email'     => 'ore@ore.com',
            'password'  => $hasher->make('password'),
        ]);

        $user->create([
            'role_id'   => 1,
            'name'      => 'saiki',
            'email'     => 'saiki@ore.com',
            'password'  => $hasher->make('password'),
        ]);
    }
}
