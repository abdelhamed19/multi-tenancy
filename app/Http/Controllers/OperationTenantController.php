<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tenant\StoreUserRequest;
use App\Models\Image;
use App\Models\User;
use App\Traits\ApiResponse;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class OperationTenantController extends Controller
{
    use ApiResponse, UploadImage;

    public function index()
    {
        $user = User::with('images')->get();
        if ($user->count() < 0) {
            return $this->errorResponse('No users found', 404);
        }
        return $this->successResponse($user, 'Users retrieved successfully');
    }
    public function show($id)
    {
        $user = User::with('images')->find($id);
        if ($user) {
            return $this->successResponse($user, 'User retrieved successfully');
        }
        return $this->errorResponse('User not found', 404);
    }
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        if ($user) {
            $image = $this->uploadImage($request->file('image'), 'users');
            Image::create([
                'user_id' => $user->id,
                'path' => $image
            ]);
            return $this->successResponse($user, 'User created successfully', 201);
        }
        return $this->errorResponse('User not created', 500);
    }
}
