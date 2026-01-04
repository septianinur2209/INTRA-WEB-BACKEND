<?php

namespace App\Models\Setting;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'role_id');
    }
}
