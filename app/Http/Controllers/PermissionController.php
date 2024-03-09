<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        return view('admin.roles.permissions.permission');
    }

    public function permissions(Request $request)
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

    /*
    |--------------------------------------------------------------------------
    | PERMISSION'S DATA --- GET
    |--------------------------------------------------------------------------
    */
    public function allPermissions(){
        $permission = Permission::get();
        return  response()->json([
            'data' => $permission,
        ], 200);
   }
}
