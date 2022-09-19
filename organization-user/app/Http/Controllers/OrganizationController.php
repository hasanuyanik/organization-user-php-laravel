<?php

namespace App\Http\Controllers;

use App\Contracts\IOrganizationService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Routing\ResponseFactory;

class OrganizationController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var IOrganizationService
     */
    private IOrganizationService $organizationService;

    /**
     * @param IOrganizationService $organizationService
     */
    public function __construct(IOrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }
    
    /**
     * @return JsonResponse
     */
    public function list()
    {
        return response()->json($this->organizationService->list());
    }

    /**
     * @param Request $request
     * 
     * @return Response|ResponseFactory
     */
    public function create(Request $request)
    {
        try{
            $this->organizationService->create([
                        'uuid' => $request->uuid,
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address
                    ]);

            return response(['message' => 'Created Successfully']);
        }catch(Exception $exception)
        {
            Log::error($exception);

            return response(['message' => 'Failed to create'], 404);
        }
    }

    /**
     * @param int $id
     * @param Request $request
     * 
     * @return Response|ResponseFactory
     */
    public function update(int $id, Request $request)
    {
        try{
            $this->organizationService->update($id, [
                        'name' => $request->name ?? null,
                        'email' => $request->email ?? null,
                        'phone' => $request->phone ?? null,
                        'address' => $request->address ?? null
                    ]);

            return response(['message' => 'Updated Successfully']);
        }catch(Exception $exception)
        {
            Log::error($exception);

            return response(['message' => 'Failed to update'], 404);
        }
    }

    /**
     * @param Request $request
     * 
     * @return Response|ResponseFactory|JsonResponse
     */
    public function byDatas(Request $request)
    {
        try{
            return response()->json(
                $this->organizationService->byDatas([
                ['name', 'like', '%'.$request->name ?? null.'%'],
                ['email', 'like', '%'.$request->email ?? null.'%'],
                ['phone', 'like', '%'.$request->phone ?? null.'%'],
                ['address', 'like', '%'.$request->address ?? null.'%']
            ])
        );
        }catch(Exception $exception)
        {
            Log::error($exception);

            return response(['message' => 'Failed to get data!'], 404);
        }
    }
}
