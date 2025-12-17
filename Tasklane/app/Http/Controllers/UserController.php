<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Get all users
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    // Get projects and tasks where user is foreign key
    public function show(User $user)
    {
        // Eager load all relations up form to avoid N + 1. 
        // Eager loading is useful when expecting to using all data.
        $user->load(['projects', 'assignedTasks']);

        // Redirect back to profile
        return view('users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate request
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Apply change
        $user->update($data);

        // Redirect back to profile with succes message
        return redirect()->route('users.show', $user)->with('success', 'Profile updated successfully.');
    }

    public function destroy(Request $request, User $user)
    {
        // Check if the user performing the delete is the user being deleted
        if(auth()->id() !== $user->id)
        {
            abort(403, 'Unauthorized action.');
        }

        $user->delete();

        // Logout, destroy session, and regenerate CSRF token
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to public page
        return redirect('/')->with('success', 'Your account has been deleted');
    }
}