@extends('layouts.app')

@section('content')
<div class="flex flex-col h-screen-90"> <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ $project->title }} Board</h1>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 transition">
            + Add Task
        </button>
    </div>

    <div class="flex flex-1 gap-4 overflow-x-auto pb-4">
        
        @php
            $statuses = ['To Do', 'Blocked', 'Doing', 'Testing', 'Done'];
        @endphp

        @foreach($statuses as $status)
        <div class="flex-1 min-w-[250px] bg-gray-50 rounded-xl border border-gray-200 flex flex-col">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-white rounded-t-xl">
                <h2 class="font-bold text-gray-700 uppercase text-xs tracking-wider">{{ $status }}</h2>
                <span class="bg-gray-200 text-gray-600 text-xs px-2 py-0.5 rounded-full">0</span>
            </div>

            <div class="p-3 space-y-3 flex-grow overflow-y-auto">
                @foreach($project->tasks->where('status', $status) as $task)
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:border-blue-400 transition cursor-pointer">
                        <h3 class="text-sm font-bold text-gray-800">{{ $task->title }}</h3>
                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $task->description }}</p>
                        
                        <div class="mt-3 flex items-center text-[10px] font-bold uppercase tracking-wider text-gray-400">
                            <span>Priority: {{ $task->priority ?? 'Medium' }}</span>
                        </div>
                    </div>
                @endforeach
                
                @if($project->tasks->where('status', $status)->count() == 0)
                    <p class="text-center text-gray-300 text-xs mt-4 italic">No tasks yet</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection