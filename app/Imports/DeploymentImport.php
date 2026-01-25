<?php

namespace App\Imports;

use App\Models\Transaction\Deployment as DeploymentModel;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DeploymentImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        Log::info('test');
        return DeploymentModel::updateOrCreate(
            [
                'id_ihld' => $row['ihld_lop_id'],
            ],
            [
                'tematik'            => $row['jenis_program'] ?? null,
                'type_deployment'    => $row['tipe_desain'] ?? null,
                'lokasi'             => $row['nama_proyek'] ?? null,
                'sto'                => $row['sto'] ?? null,
                'nilai_material'     => $row['total_boq'] ?? 0,
                'jumlah_odp_drm'     => $row['odp_plan'] ?? 0,
                'jumlah_port_drm'    => $row['total_port'] ?? 0,
                'tanggal_eprop'      => $this->parseDate($row['disubmit_pada'] ?? null),
                'batch'              => $row['batch_program'] ?? null,
                'status_tomps'       => $row['status_tomps'] ?? null,
                'status_ihld'        => $row['status_order'] ?? null,
                'status_proyek'      => $row['status_proyek'] ?? null,
                'telkomsel_branch'   => $row['telkomsel_branch'] ?? null,
            ]
        );
    }

    /**
     * Validasi per baris
     */
    public function rules(): array
    {
        return [
            'ihld_lop_id'  => 'required',
            'nama_proyek' => 'required',
            'sto'          => 'required',
            'total_port'  => 'nullable|numeric',
            'total_boq'   => 'nullable|numeric',
        ];
    }

    /**
     * Convert Excel date / string ke Y-m-d
     */
    private function parseDate($value)
    {
        if (!$value) return null;

        if (is_numeric($value)) {
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)
                ->format('Y-m-d');
        }

        return date('Y-m-d', strtotime($value));
    }
}
