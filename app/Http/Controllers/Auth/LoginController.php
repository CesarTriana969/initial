<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Actions\Panel\User\interfaces\UserInterface;
use App\Http\Requests\User\UserStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller

{

  protected $userInterface;

  public function __construct(UserInterface $userInterface)
  {
    $this->userInterface = $userInterface;

    $this->middleware('guest')->except('logout');
  }


  public function index()
  {
    return view('auth.index');
  }

  public function store(UserStoreRequest $request): JsonResponse
  {
    return $this->userInterface->store($request);
  }


  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;
}
