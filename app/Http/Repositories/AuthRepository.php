<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthRepository implements AuthInterface
{
    public function signinPage()
    {
        return view('signin');
    }

    public function signin(AuthRequest $request)
    {
        $adminData = $request->only('email', 'password');
        if(auth()->attempt($adminData)) {
            return redirect(route('admin.index'));
        }
        session()->flash('error', 'Email or Password is wrong');
        return redirect()->back();
    }

    public function signout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('signin'));
    }
}
