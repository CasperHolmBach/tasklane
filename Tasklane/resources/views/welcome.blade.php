@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[40vh] text-center">
    <h1 class="text-5xl font-extrabold text-gray-900 mb-6">
        Organize your work with <span class="text-blue-600">Tasklane</span>
    </div>
    
    <p class="text-xl text-gray-600 mb-10 max-w-2xl">
        The simple project management tool designed for students and small teams to stay on top of their deadlines.
    </p>

    <div class="flex space-x-4">
        @auth
            <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition">
                Go to Dashboard
            </a>
        @else
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition">
                Get Started for Free
            </a>
            <a href="{{ route('login') }}" class="border border-gray-300 text-gray-700 px-8 py-3 rounded-lg font-bold hover:bg-gray-50 transition">
                Log In
            </a>
        @endauth
    </div>

    <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
        <div class="p-6">
            <h3 class="font-bold text-lg mb-2">Project Tracking</h3>
            <p class="text-gray-500">Keep all your projects in one place with a clear overview of progress.</p>
        </div>
        <div class="p-6">
            <h3 class="font-bold text-lg mb-2">Task Management</h3>
            <p class="text-gray-500">Break projects down into smaller tasks and check them off one by one.</p>
        </div>
        <div class="p-6">
            <h3 class="font-bold text-lg mb-2">Team Collaboration</h3>
            <p class="text-gray-500">Invite teammates to your projects and work together in real-time.</p>
        </div>
    </div>
</div>
@endsection