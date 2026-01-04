<?php

namespace App\Repositories\Setting;

use App\Models\Setting\Role;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    /**
     * Apply filters to a query (reusable)
     */
    private function applyFilters($query, array $filters = [])
    {
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['name'])) {
            $query->where('name', 'like', "%{$filters['name']}%");
        }

        if (!empty($filters['slug'])) {
            $query->where('slug', 'like', "%{$filters['slug']}%");
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('slug', 'like', "%$search%");
            });
        }

        return $query;
    }

    /**
     * Paginated with total and filtered counts
     */
    public function getFiltered(array $filters = [], int $start = 0, int $length = 10)
    {
        $query = $this->applyFilters($this->model->query(), $filters);

        $recordsFiltered = (clone $query)->selectRaw('1')->count();
        $data = $query->skip($start)->take($length)->get();
        $recordsTotal = $this->model->selectRaw('1')->count();

        return [
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ];
    }

    /**
     * Get all data with optional filters (for export)
     */
    public function getAllWithFilter(array $filters = [], $chunkSize = 1000)
    {
        $query = $this->applyFilters($this->model->query(), $filters)
                    ->select('id','name','slug','created_at','updated_at');

        $results = [];

        $query->chunk($chunkSize, function($datas) use (&$results) {
            foreach ($datas as $value) {
                $results[] = $value;
            }
        });

        return $results;
    }

    /**
     * Dropdown data
     * column: 'name' | 'slug'
     */
    public function getDropdownData(array $filters = [])
    {
        $query = $this->applyFilters($this->model->query(), $filters);

        if (!empty($filters['column'])) {
            $column = $filters['column'] === 'name' ? 'name' : 'slug';
            return $query->distinct()->pluck($column);
        }

        return $query->pluck('id');
    }

    public function exportFiltered(array $filters = [], $fileName = 'master.xlsx')
    {
        $query = $this->applyFilters($this->model->query(), $filters)
                    ->select('id','name','slug','created_at','updated_at');

        $no = 1;

        $collection = $query->get();

        return (new FastExcel($collection))
            ->export($fileName, function ($value) use (&$no) {
                return [
                    'No'         => $no++,
                    'Role Name'  => $value->name,
                    'Slug'       => $value->slug,
                    'Created At' => Carbon::parse($value->created_at)->format('Y-m-d H:i:s'),
                    'Updated At' => Carbon::parse($value->updated_at)->format('Y-m-d H:i:s'),
                ];
            });
    }

    public function slugExists(string $slug, ?int $excludeId = null): bool
    {
        $query = $this->model->where('slug', $slug);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

}
