<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportUserRequest;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserFilters;
use App\Http\Resources\UserResource;
use App\Imports\UsersImport;
use App\Services\UserService;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function __construct(protected UserService $userService)
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the users.
     *
     * This method is used to get all users.
     */
    public function index(UserFilters $request)
    {
        $users = $this->userService->getAllUsers($request->all());

        return UserResource::collection($users);
    }


    /**
     * Store a new user.
     *
     * This method is used to create a new user.
     */
    public function store(StoreUserRequest $request)
    {
        $this->userService->createUser($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified user.
     *
     * This method is used to get a specific user.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }



    /**
     * Update the specified user.
     *
     * This method is used to update a specific user.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $this->userService->updateUser($user, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Import users from a file.
     *
     * This method is used to import users from a file.
     * You can download the file [here](https://lotery-production.up.railway.app/assets/import-users.csv)
     */
    public function import(ImportUserRequest $request)
    {
        Excel::import(new UsersImport, $request->file('file'));

        return response()->json([
            'success' => true,
            'message' => 'Users imported successfully',
        ], Response::HTTP_OK);
    }


    /**
     * Remove the specified user.
     *
     * This method is used to delete a specific user.
     */
    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ], Response::HTTP_OK);
    }
}
