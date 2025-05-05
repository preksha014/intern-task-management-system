<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
            <div class="p-6 text-xl font-bold border-b border-gray-700">
                Admin Panel
            </div>
            <nav class="mt-4 space-y-2">
                <a href="{{ route('tasks.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition">Tasks</a>
                <a href="#" class="block px-6 py-3 hover:bg-gray-700 transition">Interns</a>
                <a href="#" class="block px-6 py-3 hover:bg-gray-700 transition">Admins</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                {{ $slot }}
            </div>
        </main>
    </div>
</x-app-layout>