<?php

namespace App\Models\Transaction;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deployment extends Model
{
    use HasFactory;

    protected $table = "t_deployments";

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_ihld',
        'tematik',
        'type_deployment',
        'status_osm',
        'lokasi',
        'sto',
        'id_pid',
        'id_sap',
        'jumlah_odp_drm',
        'jumlah_port_drm',
        'nilai_drm',
        'jumlah_odp_real',
        'jumlah_port_real',
        'nilai_perijinan',
        'nilai_material',
        'nilai_jasa',
        'status_fisik',
        'status_lapangan',
        'keterangan',
        'id_sw',
        'odp',
        'mitra_id',
        'komitment_perijinan',
        'tanggal_perijinan',
        'komitment_matdev',
        'tanggal_matdev',
        'komitment_instalasi',
        'tanggal_instalasi',
        'komitment_fi',
        'tanggal_fi',
        'komitment_gl',
        'tanggal_gl',
        'pembayaran_cc',
        'tanggal_eprop',
        'batch',
        'no_po',
        'status_ihld',
        'status_tomps',
        'status_proyek',
        'telkomsel_branch',
        'ba_prelim',
        'tanggal_nde',
    ];

    public $timestamps = true;

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
    }
    
}
