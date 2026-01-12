<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuAccessRoleSuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [];
        $menus = DB::table('s_menus')->get();

        if($menus->count() > 0){
            foreach($menus as $menu){
                $datas[] = [
                    'role_id' => 1,
                    'menu_id' => $menu->id,
                    'show' => true,
                    'create' => true, 
                    'edit' => true, 
                    'delete' => true, 
                ];
            }
        }
        DB::table('menu_accesses')->insert($datas);
    }
}
