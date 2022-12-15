<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    // Method adds new user to DB
    public function registerSubmit(RegisterRequest $request)
    {
        $data = $request->validated();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('login')->withSuccess('Konto zostało utworzone');
    }

    public function login(Request $request)
    {
        return view('auth/login');
    }

    // Method logs user in
    public function loginSubmit(LoginRequest $request)
    {
        $credentials = $request->validated(); // email + password

        if (Auth::attempt($credentials)) {
            return redirect()->route('category.index')->withSuccess("Pomyślnie zalogowano się");
        } else {
            return redirect()->route('login', [
                'email' => $request->input('email'),
            ])->with('auth_failed', true);
        }
    }

    // Method logouts user
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
