<?php

namespace App\Http\Controllers;

use App\Contracts\IUserService;
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

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var IUserService
     */
    private IUserService $userService;

    /**
     * @param IUserService $userService
     */
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }
    
    /**
     * @return JsonResponse
     */
    public function list()
    {
        return response()->json($this->userService->list());
    }

    /**
     * @param Request $request
     * 
     * @return Response|ResponseFactory
     */
    public function create(Request $request)
    {
        try{
            $this->userService->create([
                        'name' => $request->name,
                        'email' => $request->email
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
            $this->userService->update($id, [
                        'name' => $request->name ?? null,
                        'email' => $request->email ?? null,
                        'password' => $request->password
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
                $this->userService->byDatas([
                ['name', 'like', '%'.$request->name ?? null.'%'],
                ['email', 'like', '%'.$request->email ?? null.'%'],
            ])
        );
        }catch(Exception $exception)
        {
            Log::error($exception);

            return response(['message' => 'Failed to get data!'], 404);
        }
    }
}
