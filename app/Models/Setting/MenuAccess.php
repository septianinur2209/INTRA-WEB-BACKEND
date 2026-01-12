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
        'menu_id',
        'show',
        'create',
        'edit',
        'delete'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    /**
     * Ambil slug lengkap (parent/child) untuk menu access
     */
    public function getFullSlug(): ?string
    {
        if (!$this->show) {
            return null;
        }

        if ($this->menu->parent_id) {
            $parent = $this->menu->parent;
            return $parent->slug . '/' . $this->menu->slug;
        }

        return $this->menu->slug;
    }

    /**
     * Ambil array semua slug dari koleksi menu access
     */
    public static function getSlugsFromCollection($menuAccessCollection): array
    {
        $slugs = ['dashboard'];

        foreach ($menuAccessCollection as $access) {
            $fullSlug = $access->getFullSlug();
            if ($fullSlug) {
                $slugs[] = $fullSlug;
            }
        }

        return array_values(array_unique($slugs));
    }
}
