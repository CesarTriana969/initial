<?php

namespace App\Actions\Panel\Role;

use App\Actions\Panel\Role\Interfaces\RoleInterface;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;

class RoleAction implements RoleInterface
{
    public function roles($request): JsonResponse
    {
        $search = $request->get('search');
        $order = $request->get('order');
        $users = Role::with('permissions')->where('id', 'LIKE', '%'.$search.'%')
            ->orwhere('name', 'LIKE', '%'.$search.'%')
            ->orderBy('id', $order)         
            ->paginate(7);
        
        return response()->json($users, 200);
    }

    public function store($request): JsonResponse
    {
        $role = Role::create([
            'name' => $request->input('name')
        ]);
        
        $role->syncPermissions($request->input('permission'));

        return response()->json([
            'message' => '¡Saved Successfully!.',
        ], 200); 
    }

    public function update($request, $id): JsonResponse
    {
        $role = Role::findOrFail($id);

        if ($request->has('name')) {
            $role->name = $request->input('name');
            $role->save();
        }

        if ($request->has('permission')) {
            $role->syncPermissions($request->input('permission'));
        }

        return response()->json([
            'message' => '¡Role updated successfully!',
        ], 200);
    }

    public function rolesName(): JsonResponse
    {
        $roles = Role::with('permissions')->get();
        return response()->json([
            'data' => $roles,
        ], 200);
    }
    
    public function permissions(): JsonResponse
    {
        $user = auth()->user();
        $roles = $user->getRoleNames();
        $permissions = [];
        
        foreach ($roles as $role) {
            $rolePermissions = Role::findByName($role)->permissions;
            foreach ($rolePermissions as $permission) {
                $permissions[] = $permission->name;
            }
        }
        
        return response()->json([
            'roles' => $roles,
            'permissions' => array_unique($permissions) 
        ]);
    }
}
