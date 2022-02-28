<?php
namespace App\Http\Interfaces;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

interface AuthInterface {

    public function signinPage();

    public function signin(AuthRequest $request);

    public function signout();
}
