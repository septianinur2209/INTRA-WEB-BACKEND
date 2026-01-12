<?php

namespace App\Models\Setting;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Role extends Model
{
    use HasFactory;

    protected $table = "s_roles";

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'status'
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

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public function menu()
    {
        return $this->hasMany(MenuAccess::class, 'role_id', 'id');
    }
}
