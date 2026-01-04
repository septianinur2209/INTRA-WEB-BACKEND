<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAccess extends Model
{
    use HasFactory;

    protected $table = "menu_accesses";

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'menu_id'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id', 'role_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id', 'menu_id');
    }
}
