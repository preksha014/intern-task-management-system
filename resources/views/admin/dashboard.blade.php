<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>
        <div class="mt-4">
            <h2 class="text-xl font-semibold">Welcome, {{ auth()->user()->name }}</h2>
            <p class="mt-2">You are logged in as an admin.</p>
        </div>
        <div class="mt-6">
            <a href="{{ route('logout') }}" class="bg-red-500 text-white px-4 py-2 rounded">Logout</a>
        </div>
    </div>
</body>
</html>