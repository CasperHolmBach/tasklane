<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

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

    <main class="container mx-auto">
        @if(session('success'))
            <div class="bg-green-200 p-4 mb-4 rounded text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>