<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\AuthInterface;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authInterface;
    public function __construct(AuthInterface $auth)
    {
        $this->authInterface = $auth;

    }

    public function signinPage()
    {
        return $this->authInterface->signinPage();
    }

    public function signin(AuthRequest $request)
    {
        return $this->authInterface->signin($request);
    }

    public function signout()
    {
        return $this->authInterface->signout();
    }
}
