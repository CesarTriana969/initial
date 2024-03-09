<?php

namespace App\Actions\Panel\User;

use App\Actions\Panel\User\interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAction implements UserInterface
{
    public function users($request): JsonResponse
    {
        $users = User::with('roles')
                ->search($request->get('search'), $request->get('order'))
                ->paginate(7);
   
        return response()->json($users, 200);
    }

    public function store($request)
    {
        try {
            $input = $request->validated();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $user->assignRole($request->input('roles'));
            return response()->json([
                'message' => '¡Saved Successfully!.',
            ], 200); 
        } catch (\Throwable $th) {
            
            return response()->json([
                'message' => '¡Server Error!.',
            ], 500); 
        }
    }

    public function update($request, int $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        $input = $request->validated();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        if ($request->has('roles')) {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request->input('roles'));
        }

        if ($request->has('services')) {
            $serviceIds = collect($request->input('services'))->pluck('id')->toArray(); 
            $user->TaxServices()->sync($serviceIds);
        }

        return response()->json([
            'message' => '¡Updated successfully!.',
        ], 200);
    }

    public function destroy($request)
    {
        $users = json_decode($request->users);
        
        foreach($users as $user){
            User::find($user)->delete();
        }

        return response()->json([
            'message' => '¡Deleted successfully!.',
        ], 200);
    }

    public function block($request)
    {
        $users = json_decode($request->users);

        foreach($users as $user){
            User::find($user)->update([
                'enabled' => false
            ]);
        }

        return response()->json([
            'message' => '¡Bloqueado correctamente!.',
        ], 200);
    }

    public function unblock($request)
    {
        $users = json_decode($request->users);

        foreach($users as $user){
            User::find($user)->update([
                'enabled' => true
            ]);
        }

        return response()->json([
            'message' => '¡Eliminado correctamente!.',
        ], 200);
    }

}