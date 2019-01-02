<?php

use Illuminate\Database\Seeder;

use App\Infrastructures\Entities\Eloquents\EloquentRole;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(EloquentRole $role)
    {
        $role1 = $role->create(
            ['name' => 'stylist']
        );

        $role2 = $role->create(
            ['name' => 'member']
        );
    }
}
