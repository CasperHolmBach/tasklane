<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Store a new task for a specific project
    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'priority' => 'required|string|max:10',
            'assigned_user_id' => 'nullable|exists:users,id',
        ]);

        // Create the task
        $task = Task::create($data);

        return redirect()->route('projects.show', $data['project_id'])->with('success', 'Task assigned!');
    }

    // Update a task
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title'  => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|in:To Do,In Progress,Done',
            'priority' => 'required|string|max:10',
            'assigned_user_id' => 'sometimes|nullable|exists:users,id',
        ]);

        // Perform the update
        $task->update($data);

        return back()->with('success', 'Task updated!');
    }

    // Patch task status
    public function updateStatus(Request $request, Task $task)
    {
        $data = $request->validate([
            'status' => 'required|string'
        ]);

        $task->update(['status' => $data['status']]);

        return back()->with('success', 'Task moved to ' . $data['status']);
    }

    // Delete a task
    public function destroy(Task $task)
    {
        // Fetch project id for feedback
        $projectId = $task->project_id;

        // Delete the task
        $task->delete();

        return redirect()->route('projects.show', $projectId)->with('succes', 'Task deleted.');
    }
}
