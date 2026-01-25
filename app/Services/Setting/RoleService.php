<?php

namespace App\Services\Setting;

use App\Repositories\Setting\RoleRepository;
use Exception;
use Illuminate\Support\Str;

class RoleService
{
    protected RoleRepository $dataRepository;
    protected $filename;

    public function __construct(RoleRepository $dataRepository)
    {
        $this->dataRepository = $dataRepository;
        $this->filename = "Roles.xlsx";
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
        if (empty($data['slug']) && !empty($data['name'])) {
            $data['slug'] = $this->generateUniqueSlug($data['name']);
        }
        return $this->dataRepository->create($data);
    }

    public function update($id, array $data)
    {
        if (!empty($data['name']) && empty($data['slug'])) {
            $data['slug'] = $this->generateUniqueSlug($data['name'], $id);
        }
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

    private function generateSlugFromName(string $name): string
    {
        $cleanedName = preg_replace('/[^a-zA-Z\s]/', '', $name);
        $cleanedName = strtolower($cleanedName);
        return Str::slug($cleanedName);
    }

    private function generateUniqueSlug(string $name, ?int $excludeId = null): string
    {
        $baseSlug = $this->generateSlugFromName($name);
        $slug = $baseSlug;
        $counter = 1;

        while ($this->dataRepository->slugExists($slug, $excludeId)) {
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug;
    }
}
