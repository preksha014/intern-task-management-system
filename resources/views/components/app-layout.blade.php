<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Task Management System') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ auth()->guard('admin')->check() ? route('admin.dashboard') : route('intern.dashboard') }}"
                                class="text-xl font-bold text-gray-800">
                                Task Management System
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="flex items-center ml-6">
                            <div class="ml-3 relative">
                                <span class="text-gray-800">{{ auth()->user()->name }}</span>
                                <form method="POST"
                                    action="{{ auth()->guard('admin')->check() ? route('admin.logout') : route('intern.logout') }}"
                                    class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="ml-4 text-sm text-red-600 hover:text-red-900">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>