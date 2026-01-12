<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            // parent menu
            [
                'parent_id' => null,
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'is_header' => false,
            ],[
                'parent_id' => null,
                'name' => 'Master',
                'slug' => 'master',
                'is_header' => true,
            ],[
                'parent_id' => null,
                'name' => 'Transaction',
                'slug' => 'transaction',
                'is_header' => true,
            ],[
                'parent_id' => null,
                'name' => 'Report',
                'slug' => 'report',
                'is_header' => true,
            ],[
                'parent_id' => null,
                'name' => 'Setting',
                'slug' => 'setting',
                'is_header' => true,
            ],

            // child
            [
                'parent_id' => 4,
                'name' => 'User',
                'slug' => 'user',
                'is_header' => false,
            ],[
                'parent_id' => 4,
                'name' => 'Role',
                'slug' => 'role',
                'is_header' => false,
            ],[
                'parent_id' => 4,
                'name' => 'Menu',
                'slug' => 'menu',
                'is_header' => false,
            ],
        ];

        
        DB::table('s_menus')->insert($menus);
    }
}
