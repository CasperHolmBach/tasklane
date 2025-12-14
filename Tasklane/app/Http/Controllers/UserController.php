<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

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
        // Eager load to avoid N + 1
        $user->load(['projects', 'assignedTasks']);

        return view('users.show', compact('user'));
    }
}