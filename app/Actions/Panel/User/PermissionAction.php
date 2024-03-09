<?php

namespace App\Actions\Panel\User;

use App\Actions\Panel\User\interfaces\PermissionInterface;
use Spatie\Permission\Models\Permission;

class PermissionAction implements PermissionInterface
{
    public function permissions($request)
    {
        $search = $request->get('search');
        $order = $request->get('order');

        $users = Permission::
            where('id', 'LIKE', '%'.$search.'%')
            ->orwhere('name', 'LIKE', '%'.$search.'%')
            ->orderBy('id', $order)         
            ->paginate(7);
        return response()->json($users, 200);
    }

    public function allPermissions(){
        $permission = Permission::get();
        return  response()->json([
            'data' => $permission,
        ], 200);
   }
}