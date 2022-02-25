<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        return $this->middleware('guest');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store()
    {
         $data = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $data['role'] = 'member';
        $data['denda'] = 0;
        $data['password'] = Hash::make(request('password'));

        User::create($data);

        auth()->attempt(request()->only('email', 'password'));

        return redirect()->route('dashboard');
    }
}
