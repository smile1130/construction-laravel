<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\{
    RegisterRequest,
    LoginRequest,
};

class AuthController extends Controller
{
    /**
     * Login view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function loginGet()
    {
        return view('auth.login');
    }

    /**
     * Register view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function registerGet()
    {
        return view('auth.register');
    }

    /**
     * Register HTTP request
     * @param  RegisterRequest	$request
     *
     * @return App\Http\Requests\Auth\Register
     */
    public function registerPost(RegisterRequest $request)
    {
        try {
            return $request->register();
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Login HTTP request
     * @param  LoginRequest	$request
     *
     * @return App\Http\Requests\Auth\Register
     */
    public function loginPost(LoginRequest $request)
    {
        try {
            return $request->login();
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Logout HTTP request
     *
     * @return Illuminate\Routing\Redirector
     */
    public function logout()
    {
        $user = auth()->user();

        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        session()->flush();

        return redirect()->route('login');
    }
}
