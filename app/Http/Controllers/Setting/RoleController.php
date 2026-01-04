<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Setting\RoleService;
use Exception;

class RoleController extends Controller
{
    protected RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = $this->roleService->getAllRoles();
        return response()->json($roles);
    }

    public function show($id)
    {
        try {
            $role = $this->roleService->getRoleById($id);
            return response()->json($role);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:s_roles,slug',
            'status' => 'required|boolean'
        ]);

        $role = $this->roleService->createRole($request->only('name','slug','status'));
        return response()->json($role, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string',
            'slug' => "sometimes|required|string|unique:s_roles,slug,$id",
            'status' => 'sometimes|required|boolean'
        ]);

        try {
            $role = $this->roleService->updateRole($id, $request->only('name','slug','status'));
            return response()->json($role);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->roleService->deleteRole($id);
            return response()->json(['message' => 'Role deleted']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
