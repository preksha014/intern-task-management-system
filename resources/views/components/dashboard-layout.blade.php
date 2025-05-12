<x-app-layout>
    <div class="flex min-h-screen bg-gray-100 overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white shadow-lg flex-shrink-0">
            <div class="p-6 border-b border-gray-700 text-2xl font-bold">
                Admin Panel
            </div>
            <nav class="mt-4 space-y-1">
                <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->is('admin/dashboard*')">
                    🏠 Dashboard
                </x-nav-link>
                @can('manage-tasks')
                    <x-nav-link href="{{ route('tasks.index') }}" :active="request()->is('admin/tasks*')">
                        📝 Tasks
                    </x-nav-link>
                @endcan
                @can('manage-interns')
                    <x-nav-link href="{{ route('interns.index') }}" :active="request()->is('admin/interns*')">
                        👨‍🎓 Interns
                    </x-nav-link>
                @endcan
                @can('manage-admins')
                    <x-nav-link href="{{ route('admins.index') }}" :active="request()->is('admin/admins*')">
                        👮 Admins
                    </x-nav-link>
                @endcan
                @can('manage-roles')
                    <x-nav-link href="{{ route('roles.index') }}" :active="request()->is('admin/roles*')">
                        🔐 Roles
                    </x-nav-link>
                @endcan
                @can('manage-permissions')
                    <x-nav-link href="{{ route('permissions.index') }}" :active="request()->is('admin/permissions*')">
                        ⚙️ Permissions
                    </x-nav-link>
                @endcan
                <x-nav-link href="{{ route('admin.chat.index') }}" :active="request()->is('admin/chat*')">
                    💬 Chats
                </x-nav-link>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-2 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>
</x-app-layout>