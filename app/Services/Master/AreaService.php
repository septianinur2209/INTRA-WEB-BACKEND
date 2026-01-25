<?php

namespace App\Services\Master;

use App\Repositories\Master\AreaRepository;
use Exception;

class AreaService
{
    protected AreaRepository $dataRepository;
    protected $filename;

    public function __construct(AreaRepository $dataRepository)
    {
        $this->dataRepository = $dataRepository;
        $this->filename = "Area.xlsx";
    }

    public function paginateWithFilter(array $filters = [])
    {
        $start = $filters['start'] ?? 0;
        $length = $filters['length'] ?? 10;

        return $this->dataRepository->getFiltered($filters, $start, $length);
    }


    public function getAllWithFilter(array $filters = [])
    {
        return $this->dataRepository->getAllWithFilter($filters);
    }

    public function getDropdown(array $filters)
    {
        return $this->dataRepository->getDropdownData($filters);
    }

    public function getById($id)
    {
        $data = $this->dataRepository->find($id);
        if (!$data) {
            throw new Exception("data not found");
        }
        return $data;
    }

    public function create(array $data)
    {
        return $this->dataRepository->create($data);
    }

    public function update($id, array $data)
    {
        $data = $this->dataRepository->update($id, $data);
        if (!$data) {
            throw new Exception("data not found");
        }
        return $data;
    }

    public function delete($id)
    {
        $deleted = $this->dataRepository->delete($id);
        if (!$deleted) {
            throw new Exception("data not found");
        }
        return $deleted;
    }

    public function export(array $filters = [], $fileName = null)
    {
        $fileName = $fileName ?? $this->filename;
        return $this->dataRepository->exportFiltered($filters, $fileName);
    }
}
