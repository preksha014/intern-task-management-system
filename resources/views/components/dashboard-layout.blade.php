<x-app-layout>
    <div class="flex min-h-screen bg-gray-100 overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white shadow-lg flex-shrink-0">
            <div class="p-6 border-b border-gray-700 text-2xl font-bold">
                Admin Panel
            </div>
            <nav class="mt-4 space-y-1">
                @can('manage-tasks')
                    <a href="{{ route('tasks.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition">
                        📝 Tasks
                    </a>
                @endcan
                @can('manage-interns')
                    <a href="{{ route('interns.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition">
                        👨‍🎓 Interns
                    </a>
                @endcan
                @can('manage-admins')
                    <a href="{{ route('admins.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition">
                        👮 Admins
                    </a>
                @endcan
                @can('manage-roles')
                    <a href="{{ route('roles.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition">
                        🔐 Roles
                    </a>
                @endcan
                @can('manage-permissions')
                    <a href="{{ route('permissions.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition">
                        ⚙️ Permissions
                    </a>
                @endcan
                <a href="{{ route('admin.chat.index') }}"
                    class="block px-6 py-3 hover:bg-gray-700 transition duration-150">
                    💬 Chats
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-2 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>
</x-app-layout>