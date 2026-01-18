<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        $regionals = [
            [
                'name' => '1',
                'code' => '1',
                'description' => 'Sumatera'
            ],[
                'name' => '2',
                'code' => '2',
                'description' => 'Jabo / Jabar'
            ]
        ];
        
        $regionalId = 2;

        $data = [
            'BEKASI'            => ['JBB','BBL','SMH','CBG','TBL','PBY','CBR','CIK','TAR','EJI','STN','CIB','BGG','LMA','PDE','KLB','PKY','KRA','BEK'],
            'BOGOR'             => ['CJU','CTR','PAR','CBI','PAG','BOO','SPL','PMU','CSN','CLS','JSA','BJD','CRI','CAU','STL','CWI','KHL','CPS','TJH','JGL','DMG','CSR','CSE','CGD','GPI','LWL','LBI','CSL','SKJ','DEP','CNE','PCM'],
            'TANGERANG'         => ['PPG','RMP','SPT','RJG','MUK','LGK','PSK','CUG'],
            'BANTEN'            => ['TJO','LWD','RKS','SKE','PDG','MLP','MEN','BAY','LBU','KMT','PSU','BRS','CKD','CWN','PBN','CRS','GRL','SAM','BJO','CLG','SEG','BJT','MER','CSK','TGR','KRS','BLJ','SAG','CKA'],
            'JAKARTA BARAT'     => ['KSB','SLP','KDY','CKG'],
            'JAKARTA TIMUR'     => ['CBB'],
            'BANDUNG BARAT'     => ['BJA','MJY','CCL','PNL','CWD','SOR','RCK','SGA','NJG','LEM','CJR','TGE','CLL','CJG','GNH','CBE','CSA','CKW','BTJ','CPT','CMI','PDL','RJW'],
            'SUKABUMI'          => ['SKM','CKK','SDL','CMO','PLR','CBD','SGN','CKB','BGL','CCR','SKB','NLD','KLU','JPK'],
            'TASIKMALAYA'       => ['KAW','CMS','PAX','BJS','BNJ','MNJ','CKJ','CBT','MLB','PMP','LAG','WNR','KDN','GRU','TSM','SPA','CIW','CBL','KNU','RJP'],
            'CIREBON'           => ['CKC','CLI','SDU','JBN','CBN','PRD','KNG','PAB','AWN','LOS','IMY','PTR','JTB','JCG','SUB','KIA','PMN','LSR','HAR','CAS','PGD','PBS','KRM','BON','RGA','CKI','JTW','KAD','MJL'],
            'KARAWANG'          => ['RDK','CPL','PLD','CBU','CKP','TLJ','KLI','PWK','WDS','KRW','CLM'],
            'BANDUNG'           => ['SMD','TAS','GGK','DGO','BDK','CCD','LBG','UBR','CJA'],
        ];

        try {
            DB::beginTransaction();

            DB::table('m_regionals')->insert($regionals);

            foreach ($data as $areaName => $stos) {
                $areaId = DB::table('m_areas')->insertGetId([
                    'regional_id' => $regionalId,
                    'name'        => $areaName,
                    'code'        => strtoupper(str_replace(' ','_',$areaName)),
                    'description' => $areaName,
                ]);

                $stoData = [];
                foreach ($stos as $sto) {
                    $stoData[] = [
                        'area_id'    => $areaId,
                        'name'       => $sto,
                        'code'       => $sto,
                        'description'=> $sto,
                    ];
                }

                DB::table('m_sto')->insert($stoData);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
