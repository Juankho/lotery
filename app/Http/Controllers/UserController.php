<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportUserRequest;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
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
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }



    /**
     * Import users from a file.
     *
     * This method is used to import users from a file.
     * You can download the file [here](https://lotery-production.up.railway.app/assets/import-users.xlsx)
     */
    public function import(ImportUserRequest $request)
    {
        Excel::import(new UsersImport, $request->file('file'));

        return response()->json([
            'success' => true,
            'message' => 'Users imported successfully',
        ], Response::HTTP_OK);
    }
}
