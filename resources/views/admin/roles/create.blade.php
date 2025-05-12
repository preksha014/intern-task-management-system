<x-dashboard-layout>
    <div>
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-xl p-8">
                <div class="mb-4 text-center">
                    <h2 class="text-xl font-bold text-gray-900">Create New Role</h2>
                    <p class="mt-1 text-sm text-gray-600">Fill in the details below to create a new role</p>
                </div>

                @if (session('success'))
                    <div class="mb-4 text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="create-role-form" action="{{ route('roles.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Role Name -->
                    <div class="space-y-1">
                        <label for="name" class="block text-sm font-semibold text-gray-700">Role Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            required>
                    </div>

                    <!-- Description -->
                    <div class="space-y-1">
                        <label for="description" class="block text-sm font-semibold text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">{{ old('description') }}</textarea>
                    </div>

                    <!-- Permissions -->
                    <div id="permissions-wrapper" class="space-y-1">
                        <label class="block text-sm font-semibold text-gray-700">Permissions</label>
                        <div class="space-y-2 max-h-60 overflow-y-auto p-4 border border-gray-200 rounded-lg shadow-sm">
                            @foreach($permissions as $permission)
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]"
                                        value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="permission_{{ $permission->id }}"
                                        class="text-sm text-gray-700 cursor-pointer">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="pt-2 flex justify-end gap-3">
                        <a href="{{ route('roles.index') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg shadow-sm">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                            Create Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>