<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <nav class="bg-white shadow mb-8 p-4">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('home') }}" class="font-bold">Tasklane</a>
            <div>
                @auth <!-- Auth based visibility -->
                    <span class="mr-4">Hello, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto">
        @if(session('success'))
            <div class="bg-green-200 p-4 mb-4 rounded text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white shadow mt-16 p-10 border-t border-gray-100">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 text-center place-items-center">
            <div>
                <h3 class="font-bold text-xl text-blue-600 mb-4">Tasklane</h3>
                <p class="text-gray-500 text-sm leading-relaxed max-w-xs mx-auto">
                    A modern project management tool built to streamline your workflow and enhance team collaboration.
                </p>
            </div>

            <div>
                <h3 class="font-bold text-gray-800 mb-4">Quick Links</h3>
                <ul class="text-gray-500 text-sm space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a></li>
                    <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Documentation</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-10 pt-8 border-t border-gray-50 text-center">
            <p class="text-gray-400 text-xs">
                &copy; {{ date('Y') }} Tasklane. All rights reserved. Built for exam purposes.
            </p>
        </div>
    </footer>   
</body>
</html>