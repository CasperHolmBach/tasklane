<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // List all project the user is related to
    public function index()
    {
        // Use auth() to only get current user's projects
        $projects = auth()->user()->projects()->withCount('tasks')->get();
        
        return view('dashboard.index', compact('projects'));
    }

    // Return project creation form
    public function create()
    {
        return view('projects.create');
    }

    // Create a project
    public function store(Request $request)
    {
        // Validate request
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create the project
        $project = Project::create($data);

        // Attach the current user to the created project via 'teams' pivot table
        $project->users()->attach(auth()->id());

        return redirect()->route('projects.show', $project)->with('success', 'Project created!');
    }

    // Show a specific project with all its tasks and team members
    public function show(Project $project)
    {
        // Eager load tasks and users since this will be used to list everything
        // Avoids N+1 Database queries for related data
        $project->load(['task.assignedUser', 'users']);

        return view('projects.show', compact('project'));
    }
}
