<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function store(UserRequest $request, UserService $userService) {
        try {
            $user = $userService->create($request->all());

            return response()->json(['data' => new UserResource($user), 'message' => 'Usuario criado com sucesso'], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function index() {
        return UserResource::collection(User::all());
    }
}
