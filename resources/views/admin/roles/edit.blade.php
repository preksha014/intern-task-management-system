<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-xl p-8">
                <div class="mb-6 text-center">
                    <h2 class="text-2xl font-semibold text-gray-800">Edit Role</h2>
                    <p class="mt-1 text-sm text-gray-600">Update the details below to modify the role</p>
                </div>

                @if (session('success'))
                    <div class="mb-4 text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="edit-role-form" action="{{ route('roles.update', $role) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Role Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700">Role Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}"
                            class="w-full mt-1 px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full mt-1 px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">{{ old('description', $role->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Permissions -->
                    <div id="permissions-wrapper" class="space-y-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Permissions</label>
                        <div class="space-y-2 max-h-60 overflow-y-auto p-4 border border-gray-200 rounded-lg shadow-sm">
                            @foreach($permissions as $permission)
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]"
                                        value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="permission_{{ $permission->id }}"
                                        class="text-sm text-gray-700 cursor-pointer">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('permissions')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="pt-2 flex justify-end gap-3">
                        <a href="{{ route('roles.index') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg shadow-sm">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                            Update Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>