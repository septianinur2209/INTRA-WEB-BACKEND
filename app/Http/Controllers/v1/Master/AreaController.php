<?php

namespace App\Http\Controllers\v1\Master;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\AreaRequest;
use App\Services\Master\AreaService;
use Illuminate\Http\Request;
use Throwable;

class AreaController extends Controller
{
    protected AreaService $dataService;

    public function __construct(AreaService $dataService)
    {
        $this->dataService = $dataService;
    }

    public function index(Request $request, $perPage = 10)
    {
        try {
            $filters = $request->only(['start','length','status','name','slug','description','search']);

            $result = $this->dataService->paginateWithFilter($filters);

            return ResponseHelper::success(
                200,
                'Datas retrieved successfully',
                [
                    'recordsTotal' => $result['recordsTotal'],
                    'recordsFiltered' => $result['recordsFiltered'],
                    'data' => $result['data']
                ]
            );
        } catch (Throwable $e) {
            return ResponseHelper::error(
                500,
                $e->getMessage()
            );
        }
    }

    public function dropdown(Request $request)
    {
        try {
            $filters = $request->only(['column','name','slug']);
            $data = $this->dataService->getDropdown($filters);

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
            $data = $this->dataService->getById($id);

            return ResponseHelper::success(
                200,
                'Data retrieved successfully',
                $data
            );
        } catch (Throwable $e) {
            return ResponseHelper::error(
                404,
                $e,
                'Menu not found'
            );
        }
    }

    public function store(AreaRequest $request)
    {
        try {
            $data = $this->dataService->create($request->validated());

            return ResponseHelper::success(
                201,
                'Data created successfully',
                $data
            );
        } catch (Throwable $e) {
            return ResponseHelper::error(
                500,
                $e->getMessage()
            );
        }
    }

    public function update(AreaRequest $request, $id)
    {
        try {
            $data = $this->dataService->update($id, $request->validated());

            return ResponseHelper::success(
                200,
                'Data updated successfully',
                $data
            );
        } catch (Throwable $e) {
            return ResponseHelper::error(
                404,
                $e,
                'Data not found'
            );
        }
    }

    public function destroy($id)
    {
        try {
            $this->dataService->delete($id);

            return ResponseHelper::success(
                200,
                'Data deleted successfully',
                null
            );
        } catch (Throwable $e) {
            return ResponseHelper::error(
                404,
                $e,
                'Data not found'
            );
        }
    }

    public function export(Request $request)
    {
        try {
            $filters = $request->only(['status', 'name', 'code', 'description', 'search']);
            $fileName = 'Area_' . date('Ymd_His') . '.xlsx';

            $filePath = $this->dataService->export($filters, $fileName);

            return response()->download($filePath)->deleteFileAfterSend(true);
        } catch (Throwable $e) {
            return ResponseHelper::error(
                500,
                $e,
                'Failed to export datas'
            );
        }
    }
}
