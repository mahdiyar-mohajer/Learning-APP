<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Get the authenticated user

            // Check if the user is active
            if (!$user->active) {
                // Log the user out and return an error message if inactive
                Auth::logout();
                return redirect()->back()->withErrors(['email' => 'Your account is deactivated. Please contact support.']);
            }

            // Check the user's role and redirect accordingly
            if ($user->role === 'admin') {
                return redirect()->intended('admin'); // Redirect to the admin panel
            } elseif ($user->role === 'user') {
                return redirect()->intended('/'); // Redirect to the user dashboard
            }
        }

        // If authentication fails, show an error message
        return redirect()->back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        Auth::login($user);
        return redirect('/');
    }
}
