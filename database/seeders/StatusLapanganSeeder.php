<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusLapanganSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['code' => '0.0', 'name' => 'DROP/PENDING', 'description' => 'DROP/PENDING'],

            ['code' => '1.1', 'name' => 'PERMIT', 'description' => 'PERMIT'],
            ['code' => '1.2', 'name' => 'SURVEY', 'description' => 'SURVEY'],
            ['code' => '1.3', 'name' => 'DRM', 'description' => 'DRM'],

            ['code' => '2.1', 'name' => 'PENGAJUAN PID', 'description' => 'PENGAJUAN PID'],
            ['code' => '2.2', 'name' => 'PERIJINAN', 'description' => 'PERIJINAN'],
            ['code' => '2.3', 'name' => 'MATERIAL DELIVERY', 'description' => 'MATERIAL DELIVERY'],

            ['code' => '3.1', 'name' => 'TANAM TIANG', 'description' => 'TANAM TIANG'],
            ['code' => '3.2', 'name' => 'GALIAN KABEL', 'description' => 'GALIAN KABEL'],
            ['code' => '3.3', 'name' => 'TARIK FO', 'description' => 'TARIK FO'],
            ['code' => '3.4', 'name' => 'INSTALL ODC', 'description' => 'INSTALL ODC'],
            ['code' => '3.5', 'name' => 'INSTALL ODP', 'description' => 'INSTALL ODP'],
            ['code' => '3.6', 'name' => 'TERMINASI', 'description' => 'TERMINASI'],
            ['code' => '3.7', 'name' => 'PERAPIHAN', 'description' => 'PERAPIHAN'],

            ['code' => '4.1', 'name' => 'FINISH INSTALASI', 'description' => 'FINISH INSTALASI'],
            ['code' => '4.2', 'name' => 'PROSES GOLIVE', 'description' => 'PROSES GOLIVE'],
            ['code' => '4.3', 'name' => 'GOLIVE', 'description' => 'GOLIVE'],
            ['code' => '4.4', 'name' => 'COMMISIONING TEST', 'description' => 'COMMISIONING TEST'],
            ['code' => '4.5', 'name' => 'UJI TERIMA', 'description' => 'UJI TERIMA'],

            ['code' => '5.1', 'name' => 'PEMBERKASAN', 'description' => 'PEMBERKASAN'],
            ['code' => '5.2', 'name' => 'PRA REKON', 'description' => 'PRA REKON'],
            ['code' => '5.3', 'name' => 'REKON', 'description' => 'REKON'],

            ['code' => '6.1', 'name' => 'BAST-1', 'description' => 'BAST-1'],
        ];

        DB::table('s_status_lapangans')->insert($statuses);
    }
}
