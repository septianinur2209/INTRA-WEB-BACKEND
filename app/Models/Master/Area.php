<?php

namespace App\Models\Master;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = "m_areas";

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'regional_id',
        'name',
        'code',
        'description',
        'status',
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

    public function regional()
    {
        return $this->belongsTo(Regional::class, 'regional_id', 'id');
    }
}
