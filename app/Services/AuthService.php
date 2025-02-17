<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function createAccount(Request $request) {

        $role = Role::create(['name' => 'admin']);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> $request->password,
        ]);

        $user->assignRole('admin');

        Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Account successfully created!'
        ]);
    }

    public function signIn(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if(!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
                'password' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return response()->json([
            'status' => 'success',
            'message' => 'Signed in!',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out!'
        ]);
    }
}
