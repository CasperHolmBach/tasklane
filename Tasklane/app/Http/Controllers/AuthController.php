<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate request data for registering
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Requires password to be written right twice
        ]);

        // Create user. 
        // Password gets hashed by the Cast() function within the User model
        $user = User::create($data);

        // Login the user
        Auth::login($user);

        // Redirect to dashboard page
        return redirect()->route('dashboard')->with('success', 'Account created');
    }

    public function login(Request $request)
    {
        // Validate request data for logging in
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check database for user with the given credentials
        if(Auth::attempt($credentials))
        {
            // Regenerate session ID to prevent "session fixation" attacks
            // These are attack where a hacker pre-sets a session ID for a victim
            $request->session()->regenerate();

            // Redirect to the route the user was trying to access before login.
            // Fallback to dashboard route, if login was accessed directly.
            return redirect()->intended('dashboard');
        }

        // Send user back to login page.
        return back()->withErrors([
            'email' => 'This user does not exist',
        ])->onlyInput('email'); // Keeps email to avoid retype
    }

    public function logout(Request $request)
    {
        // Logout from session
        Auth::logout();

        // Flush data from session (makes it invalid)
        $request->session()->invalidate();

        // Regenerate CSRF token to prevent Cross-Site Request Forgery
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
