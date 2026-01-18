<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StatusLopSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Persiapan',
            'perijinan',
            'MATDEV',
            'Instalasi',
            'Finish Instalasi',
            'Testcom (GOLIVE)',
            'Admin',
            'CT',
            'UT',
            'REKON',
            'BAST',
        ];

        $data = [];

        foreach ($names as $name) {
            $data[] = [
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $name,
            ];
        }

        DB::table('s_status_lops')->insert($data);
    }
}
