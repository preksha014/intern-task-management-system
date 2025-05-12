<x-dashboard-layout>
    <div>
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-xl p-8">
                <div class="mb-4 text-center">
                    <h2 class="text-xl font-bold text-gray-900">Edit Permission</h2>
                    <p class="mt-1 text-sm text-gray-600">Update the permission name and slug below</p>
                </div>

                @if (session('success'))
                    <div class="mb-4 text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="edit-permission-form" action="{{ route('permissions.update', $permission) }}" method="POST"
                    class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <!-- Name -->
                    <div class="space-y-1">
                        <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $permission->name) }}"
                            class="permission-name w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            required>
                    </div>

                    <!-- Slug -->
                    <div class="space-y-1">
                        <label for="slug" class="block text-sm font-semibold text-gray-700">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $permission->slug) }}"
                            class="permission-slug w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            readonly>
                    </div>

                    <!-- Actions -->
                    <div class="pt-2 flex justify-end gap-3">
                        <a href="{{ route('permissions.index') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg shadow-sm">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                            Update Permission
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>

<script>
    $(document).ready(function () {
        $('.permission-name').on("input", function () {
            let slug = $(this).val()
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            $('.permission-slug').val(slug);
        });
    });
</script>