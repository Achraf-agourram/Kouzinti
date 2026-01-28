<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authPage ()
    {
        return view('auth');
    }

    public function login (Request $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            $request->session()->regenerate();

            redirect('/home');
        }

        return redirect('/login')->with('failed', 'Invalid credentials');
    }

    public function register (Request $request)
    {
        User::create($request->only(['fullName', 'email', 'password']));

        return redirect('/login')->with('success', 'Account created successfully');
    }
}
