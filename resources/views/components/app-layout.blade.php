<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>

    <!-- Toastr CSS & JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <title>{{ config('app.name', 'Task Management System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 h-screen">
    <div class="flex flex-col min-h-screen">
        <!-- Navigation Bar -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md border-b border-gray-200">
            <div class="max-w-full mx-auto px-6">
                <div class="flex justify-between items-center h-16">
                    <!-- Left: App Logo -->
                    <div class="flex items-center space-x-2">
                        <a href="{{ auth()->check() ? (auth()->user()->isAdmin() ? route('admin.dashboard') : route('intern.dashboard')) : '/' }}"
                            class="text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors duration-150">
                            Task Management System
                        </a>
                    </div>

                    <!-- Right: User Info -->
                    <div class="flex items-center space-x-6">
                        @auth
                            <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                            <!-- Enhanced Notification Icon -->
                            @if(auth()->user()->isIntern())
                                <div class="relative inline-block mr-2">
                                    <a href="{{ route('notifications.index') }}"
                                        class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors duration-150 text-gray-700 hover:text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="h-5 w-5">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                        </svg>
                                        @if(Auth::user()->intern->unreadNotifications->count() > 0)
                                            <span
                                                class="absolute -top-1 -right-1 flex items-center justify-center h-5 w-5 text-xs font-bold text-white bg-red-500 rounded-full shadow-sm border border-white">
                                                {{ Auth::user()->intern->unreadNotifications->count() }}
                                            </span>
                                        @endif
                                    </a>
                                </div>
                            @endif
                            <form method="POST"
                                action="{{ auth()->user()->isAdmin() ? route('admin.logout') : route('intern.logout') }}">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition">
                                    Logout
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="pt-16">
            <main class="flex-grow overflow-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
    @if(session('success'))
        <script>
            $(document).ready(function () {
                toastr.success("{{ session('success') }}");
            });
        </script>
    @elseif(session('error'))
        <script>
            $(document).ready(function () {
                toastr.error("{{ session('error') }}");
            });
        </script>
    @endif
</body>

</html>