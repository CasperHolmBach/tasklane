@extends('layouts.app')

@push('scripts')
    @vite('resources/js/modal.js')
@endpush

@section('content')
<div class="flex flex-col h-screen-90"> <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ $project->title }} Board</h1>
        <button id="open" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 transition">
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
                <span class="bg-gray-200 text-gray-600 text-xs px-2 py-0.5 rounded-full">
                    {{ $project->tasks->where('status', $status)->count() }}
                </span>
            </div>

            <div class="p-3 space-y-3 flex-grow overflow-y-auto">
                <!-- Put the task in the appropriate column-->
                @foreach($project->tasks->where('status', $status) as $task)
                    <div class="relative group bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:border-blue-400 transition cursor-pointer">
                        <h3 class="text-sm font-bold text-gray-800">{{ $task->title }}</h3>
                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $task->description }}</p>
                        
                        <!-- Delete button SVG-->
                        <div class="absolute top-3 right-2 z-20">
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onclick="event.stopPropagation();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Delete task?')"
                                        class="text-gray-300 hover:text-red-600 transition-colors p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <div class="mt-3 flex items-center text-[10px] font-bold uppercase tracking-wider text-gray-400">
                            <span>Priority: {{ $task->priority }}</span>
                        </div>

                        <!-- Status dropdown -->
                        <form action="{{ route('tasks.updateStatus', $task) }}" method="POST">
                            @csrf
                            @method('PATCH') <select name="status" onchange="this.form.submit()" class="text-[10px] bg-gray-100 border-none rounded p-1 mt-2 cursor-pointer">
                                @foreach($statuses as $statusOption)
                                    <option value="{{ $statusOption }}" {{ $task->status == $statusOption ? 'selected' : '' }}>
                                        {{ $statusOption }}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                    </div>
                @endforeach
                
                <!-- Placeholder text -->
                @if($project->tasks->where('status', $status)->count() == 0)
                    <p class="text-center text-gray-300 text-xs mt-4 italic">No tasks yet</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Create project modal: Hidden until create button is pressed -->
    <div id="modalContainer" class="hidden fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-50 items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
            <h3 class="text-xl font-bold mb-4">Add a new task</h3>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <input type="hidden" name="project_id" value="{{ $project->id }}">

                <div class="mb-2">
                    <label>Title</label>
                    <input name="title" type="text" class="border w-full rounded-lg px-3 py-2">
                </div>

                <div class="mb-2">
                    <label>Description</label>
                    <textarea name="description" rows="4" class="border w-full rounded-lg px-3 py-2"></textarea>
                </div>

                <div class="mb-2">
                    <label>Due Date</label>
                    <input name="due_date" type="date" class="border w-full rounded-lg px-3 py-2">
                </div>
                
                <div clas="mb-6">
                    <label>Priority</label>
                    <select name="priority" id="priority" class="w-full px-4 py-3 border rounded-xl appearance-none focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none bg-white transition cursor-pointer">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                        <option value="Critical">Critical</option>
                    </select>
                </div>

                <div class="gap-3 mt-6">
                    <button type="submit" class="bg-blue-600 text-white rounded-lg hover:bg-blue-700 px-2 py-1 transition">
                        Create
                    </button>
                    <button id="cancel" type="button" class="bg-gray-400 text-white rounded-lg hover:bg-gray-500 px-2 py-1 transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection