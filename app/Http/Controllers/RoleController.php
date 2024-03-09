<?php

namespace App\Http\Controllers;

use App\Actions\Panel\Role\Interfaces\RoleInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $roleInterface;

    public function __construct(RoleInterface $roleInterface)
    {
        $this->roleInterface = $roleInterface;

        $this->middleware('permission:view-roles', ['only'=>['index','roles']]);
        $this->middleware('permission:create-role', ['only'=>['create','store']]);
        $this->middleware('permission:edit-role', ['only'=>['update']]);
        $this->middleware('permission:delete-role', ['only'=>['destroy']]);
    }

    public function index(): Renderable
    {
        return view('admin.roles.role');
    }

    public function roles(Request $request): JsonResponse
    {
        return $this->roleInterface->roles($request);
    }

    public function create(): Renderable
    {
        return view('admin.roles.create');
    }

    public function store(Request $request): JsonResponse
    {
        return $this->roleInterface->store($request);
    }

    public function update(Request $request, $id): JsonResponse
    {
        return $this->roleInterface->update($request, $id);
    }

    public function rolesName(): JsonResponse
    {
        return $this->roleInterface->rolesName();
    }
    
    public function permissions(): JsonResponse
    {
       return $this->roleInterface->permissions();
    }
}
