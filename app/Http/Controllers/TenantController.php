<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Events\TenantCreated;
use App\Http\Requests\Tenant\StoreTenantRequest;

class TenantController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $tenants = Tenant::all();
        if ($tenants->count() > 0)
        {
            return $this->successResponse($tenants, 'Tenants retrieved successfully');
        }
        return $this->errorResponse('No tenants found', 404);
    }
    public function show($id)
    {
        $tenant = Tenant::find($id);
        if ($tenant)
        {
            return $this->successResponse($tenant, 'Tenant retrieved successfully');
        }
        return $this->errorResponse('Tenant not found', 404);
    }
    public function store(StoreTenantRequest $request)
    {
        $data = $request->validated();
        $tenant = Tenant::create($data);
        if ($tenant)
        {
            event(new TenantCreated($tenant));
            return $this->successResponse($tenant, 'Tenant created successfully', 201);
        }

        return $this->errorResponse('Tenant not created', 500);
    }
    public function destroy($id)
    {
        $tenant = Tenant::find($id);
        if ($tenant)
        {
            $tenant->delete();
            return $this->successResponse(null, 'Tenant deleted successfully');
        }
        return $this->errorResponse('Tenant not found', 404);
    }
}
