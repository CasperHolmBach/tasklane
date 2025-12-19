@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-gray-600">Welcome back, {{ auth()->user()->name }}. Here is your overview.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <span class="text-gray-500 text-sm uppercase font-bold tracking-wider">Total Projects</span>
        <p class="text-3xl font-black text-blue-600">{{ $projects->count() }}</p>
    </div>
    </div>

<h2 class="text-xl font-bold mb-4">Your Projects</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($projects as $project)
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
            <h3 class="font-bold text-lg mb-2">{{ $project->name }}</h3>
            <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $project->description }}</p>
            
            <div class="flex justify-between items-center mt-4 pt-4 border-t">
                <span class="text-xs font-semibold bg-gray-100 px-2 py-1 rounded text-gray-600">
                    {{ $project->tasks_count }} Tasks
                </span>
                <a href="{{ route('projects.show', $project) }}" class="text-blue-600 text-sm font-bold hover:underline">
                    View Project &rarr;
                </a>
            </div>
        </div>
    @endforeach

    <a href="{{ route('projects.create') }}" class="border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center p-6 hover:bg-gray-50 transition group">
        <span class="text-3xl text-gray-400 group-hover:text-blue-500">+</span>
        <span class="text-gray-500 font-medium group-hover:text-blue-500">New Project</span>
    </a>
</div>
@endsection