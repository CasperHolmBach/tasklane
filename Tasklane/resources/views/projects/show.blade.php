@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ $project->name }}</h1>
    <p class="text-gray-600 mb-8">{{ $project->description }}</p>

    <h2 class="text-xl font-semibold mb-4">Tasks</h2>
    <ul class="space-y-4">
        @foreach($project->tasks as $task)
            <li class="flex justify-between items-center p-4 border rounded">
                <div>
                    <span class="font-medium">{{ $task->title }}</span>
                    <span class="text-sm text-gray-400 ml-2">({{ $task->status }})</span>
                    <br>
                    <small class="text-gray-500">
                        Assigned to: {{ $task->assignedUser->name ?? 'Unassigned' }}
                    </small>
                </div>

                <div class="flex gap-2">
                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="Done">
                        <button class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Mark as Done</button>
                    </form>

                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 text-sm">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection