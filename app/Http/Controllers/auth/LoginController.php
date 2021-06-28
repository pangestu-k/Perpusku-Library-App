<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function __construct()
    {
        return $this->middleware('guest');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function store()
    {
        $data = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($data, request()->remember)) {
            return redirect()->route('dashboard');
        } else {
            return back()->with('status', 'Invalid Login Account');
        }
    }
}
