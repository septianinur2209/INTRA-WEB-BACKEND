<?php

namespace App\Repositories\Setting;

use App\Models\Setting\Role;

class RoleRepository
{
    public function all()
    {
        return Role::all();
    }

    public function find($id)
    {
        return Role::find($id);
    }

    public function create(array $data)
    {
        return Role::create($data);
    }

    public function update($id, array $data)
    {
        $role = $this->find($id);
        if ($role) {
            $role->update($data);
        }
        return $role;
    }

    public function delete($id)
    {
        $role = $this->find($id);
        if ($role) {
            $role->delete();
            return true;
        }
        return false;
    }
}
