<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function authPage ()
    {
        return view('auth');
    }

    public function login ()
    {
        echo "<script>console.log('logged')</script>";

        return redirect('/login');
    }

    public function register (Request $request)
    {
        User::create($request->only(['fullName', 'email', 'password']));

        return redirect('/login')->with('success', 'Account created successfully');
    }
}
