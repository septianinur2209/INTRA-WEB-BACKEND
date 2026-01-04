<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Setting\RoleService;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Setting\RoleRequest;
use Throwable;

class RoleController extends Controller
{
    protected RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(Request $request, $perPage = 10)
    {
        try {
            $filters = $request->only(['start','length','status','name','slug','search']);

            $result = $this->roleService->paginateWithFilter($filters);

            return ResponseHelper::success(
                200,
                'Roles retrieved successfully',
                [
                    'recordsTotal' => $result['recordsTotal'],
                    'recordsFiltered' => $result['recordsFiltered'],
                    'data' => $result['data']
                ]
            );
        } catch (Throwable $e) {
            return ResponseHelper::error(
                500,
                $e
            );
        }
    }

    public function dropdown(Request $request)
    {
        try {
            $filters = $request->only(['column','name','slug']);
            $data = $this->roleService->getDropdown($filters);

            return ResponseHelper::success(
                200,
                'Dropdown data retrieved successfully',
                $data
            );
        } catch (\Throwable $e) {
            return ResponseHelper::error(
                500,
                $e,
                'Failed to get dropdown data'
            );
        }
    }

    public function detail($id)
    {
        try {
            $role = $this->roleService->getById($id);

            return ResponseHelper::success(
                200,
                'Role retrieved successfully',
                $role
            );
        } catch (Throwable $e) {
            return ResponseHelper::error(
                404,
                $e,
                'Role not found'
            );
        }
    }

    public function store(RoleRequest $request)
    {
        try {
            $role = $this->roleService->create($request->validated());

            return ResponseHelper::success(
                201,
                'Role created successfully',
                $role
            );
        } catch (Throwable $e) {
            return ResponseHelper::error(
                500,
                $e
            );
        }
    }

    public function update(RoleRequest $request, $id)
    {
        try {
            $role = $this->roleService->update($id, $request->validated());

            return ResponseHelper::success(
                200,
                'Role updated successfully',
                $role
            );
        } catch (Throwable $e) {
            return ResponseHelper::error(
                404,
                $e,
                'Role not found'
            );
        }
    }

    public function destroy($id)
    {
        try {
            $this->roleService->delete($id);

            return ResponseHelper::success(
                200,
                'Role deleted successfully',
                null
            );
        } catch (Throwable $e) {
            return ResponseHelper::error(
                404,
                $e,
                'Role not found'
            );
        }
    }

    public function export(Request $request)
    {
        try {
            $filters = $request->only(['status', 'name', 'slug', 'search']);
            $fileName = 'roles_' . date('Ymd_His') . '.xlsx';

            $filePath = $this->roleService->export($filters, $fileName);

            return response()->download($filePath)->deleteFileAfterSend(true);
        } catch (Throwable $e) {
            return ResponseHelper::error(
                500,
                $e,
                'Failed to export roles'
            );
        }
    }
}
