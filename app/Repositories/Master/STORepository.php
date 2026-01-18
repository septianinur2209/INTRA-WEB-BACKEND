<?php

namespace App\Repositories\Master;

use App\Models\Master\STO;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;

class STORepository extends BaseRepository
{
    public function __construct(STO $model)
    {
        parent::__construct($model);
    }

    /**
     * Apply filters to a query (reusable)
     */
    private function applyFilters($query, array $filters = [])
    {
        $query->with('area');

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['name'])) {
            $query->where('name', 'like', "%{$filters['name']}%");
        }

        if (!empty($filters['code'])) {
            $query->where('code', 'like', "%{$filters['code']}%");
        }

        if (!empty($filters['description'])) {
            $query->where('description', 'like', "%{$filters['description']}%");
        }

        if (!empty($filters['area'])) {
            $query->whereHas('area', function ($r) use ($filters) {
                $r->where('code', 'like', "%{$filters['area']}%");
            });
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('code', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%")
                  ->orWhereHas('area', function ($r) use ($search) {
                    $r->where('name', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%");
                });
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
                    ->with('area')
                    ->select('id','area_id','name','code','description','status','created_at','updated_at');

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

        /**
         * Dropdown AREA
         */
        if (!empty($filters['type']) && $filters['type'] === 'area') {
            return $query
                ->with('area')
                ->get()
                ->pluck('area.name')
                ->unique()
                ->filter();
        }

        /**
         * Dropdown AREA by area
         */
        if (!empty($filters['area_id'])) {
            $query->where('area_id', $filters['area_id']);
        }

        /**
         * Custom column dropdown (AREA)
         * example: column = 'name' | 'code'
         */
        if (!empty($filters['column'])) {
            return $query
                ->orderBy($filters['column'])
                ->pluck($filters['column'], 'id');
        }

        /**
         * Default dropdown
         */
        return $query
            ->orderBy('name')
            ->pluck('name', 'id');
    }

    public function exportFiltered(array $filters = [], $fileName = 'master.xlsx')
    {
        $query = $this->applyFilters($this->model->query(), $filters)
                    ->with('area')
                    ->select('id','name','code','description','status','created_at','updated_at');

        $no = 1;

        $collection = $query->get();

        return (new FastExcel($collection))
            ->export($fileName, function ($value) use (&$no) {
                return [
                    'No'         => $no++,
                    'Area ID'    => optional($value->area)->name,
                    'Area Name'  => optional($value->area)->description,
                    'Name'       => $value->name,
                    'Code'       => $value->code,
                    'Description'=> $value->description,
                    'Status'     => $value->status ? "Active" : "Inactive",
                    'Created At' => Carbon::parse($value->created_at)->format('Y-m-d H:i:s'),
                    'Updated At' => Carbon::parse($value->updated_at)->format('Y-m-d H:i:s'),
                ];
            });
    }
}
