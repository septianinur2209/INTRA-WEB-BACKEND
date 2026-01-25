<?php

namespace App\Http\Controllers\v1\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DeploymentExport;
use App\Helpers\ResponseHelper;
use App\Imports\DeploymentImport;
use App\Models\Transaction\Deployment;
use Illuminate\Support\Facades\Log;

class DeploymentController extends Controller
{
    public function index(Request $request)
    {
        try{
            $data = Deployment::all();
            return ResponseHelper::success(
                200,
                'success',
                $data
            );
        } catch (\Throwable $e) {
            Log::error($e);
            return ResponseHelper::error(
                500,
                $e->getMessage()
            );
        }
    }
    
    public function dropdown(Request $request)
    {
        
    }
    
    public function detail($id)
    {
        
    }
    
    public function store(Request $request)
    {
        
    }
    
    public function update(Request $request, $id)
    {
        
    }
    
    public function destroy($id)
    {
        
    }
    
    public function export(Request $request)
    {
        return Excel::download(
            new DeploymentExport($request),
            'deployment_' . date('Ymd_His') . '.xlsx'
        );  
    }
    
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new DeploymentImport, $request->file('file'));

            return ResponseHelper::success(
                200,
                'Datas Imported successfully',
                []
            );
        } catch (\Throwable $e) {
            Log::error($e);
            return ResponseHelper::error(
                500,
                $e->getMessage()
            );
        }
    }
    
    public function whereData()
    {
        
    }
}
