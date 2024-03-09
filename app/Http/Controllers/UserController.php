<?php
namespace App\Http\Controllers;

use App\Actions\Panel\User\interfaces\UserInterface;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;

        $this->middleware('permission:view-users', ['only'=>['index','users']]);
        $this->middleware('permission:create-user', ['only'=>['create','store']]);
        $this->middleware('permission:edit-user', ['only'=>['edit','update']]);
        $this->middleware('permission:delete-user', ['only'=>['destroy']]);
    }

    public function index(): Renderable
    {
        return view('admin.users.user');
    }

    public function users(Request $request): JsonResponse
    {
        return $this->userInterface->users($request);
    }

    public function create(): Renderable
    {
        return view('admin.users.create');
    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        return $this->userInterface->store($request);
    }

    public function edit(int $id): Renderable
    {
        $user = User::with(['roles'])->find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, int $id): JsonResponse
    {
        return $this->userInterface->update($request, $id);
    }

    public function destroy(Request $request): JsonResponse
    {
        return $this->userInterface->destroy($request);
    }
}
