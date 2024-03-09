<?php

namespace App\Actions\Panel\User;

use App\Actions\Panel\User\interfaces\RoleInterface;
use Spatie\Permission\Models\Role;

class RoleAction implements RoleInterface
{
    public function roles($request)
    {
        $search = $request->get('search');
        $order = $request->get('order');
        $users = Role::where('id', 'LIKE', '%'.$search.'%')
            ->orwhere('name', 'LIKE', '%'.$search.'%')
            ->orderBy('id', $order)         
            ->paginate(7);
        
        return response()->json($users, 200);
    }

    public function store($request)
    {
       $role = Role::create([
            'name' => $request->input('name')
        ]);
        
        $role->syncPermissions($request->input('permission'));

        return response()->json([
            'message' => '¡Guardado Correctamente!.',
        ], 200); 
    }

    public function rolesName()
    {
        $roles = Role::all();
        return response()->json([
            'data' => $roles,
        ], 200);
    }
}   