<?php

namespace App\Services\Setting;

use App\Repositories\Setting\RoleRepository;
use Exception;

class RoleService
{
    protected RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAllRoles()
    {
        return $this->roleRepository->all();
    }

    public function getRoleById($id)
    {
        $role = $this->roleRepository->find($id);
        if (!$role) {
            throw new Exception("Role not found");
        }
        return $role;
    }

    public function createRole(array $data)
    {
        // Bisa tambahkan validasi di sini
        return $this->roleRepository->create($data);
    }

    public function updateRole($id, array $data)
    {
        $role = $this->roleRepository->update($id, $data);
        if (!$role) {
            throw new Exception("Role not found");
        }
        return $role;
    }

    public function deleteRole($id)
    {
        $deleted = $this->roleRepository->delete($id);
        if (!$deleted) {
            throw new Exception("Role not found");
        }
        return $deleted;
    }
}
