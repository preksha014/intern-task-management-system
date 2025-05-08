<x-dashboard-layout>
    <div>
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-xl p-8">
                <div class="mb-4 text-center">
                    <h2 class="text-xl font-bold text-gray-900">Edit Intern</h2>
                    <p class="mt-1 text-sm text-gray-600">Update intern details below</p>
                </div>

                <form action="{{ route('interns.update', $intern->id) }}" method="POST" id="edit-intern-form" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <!-- Name -->
                    <div class="space-y-1">
                        <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $intern->user->name) }}"
                            class="w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                       
                    </div>

                    <!-- Email -->
                    <div class="space-y-1">
                        <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $intern->user->email) }}"
                            class="w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        
                    </div>

                    <!-- Department -->
                    <div class="space-y-1">
                        <label for="department" class="block text-sm font-semibold text-gray-700">Department</label>
                        <input type="text" name="department" id="department" value="{{ old('department', $intern->department) }}"
                            class="w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                       
                    </div>

                    <!-- Password Note -->
                    <p class="text-sm text-gray-500">Leave password fields empty if you don't want to change it.</p>

                    <!-- New Password -->
                    <div class="space-y-1">
                        <label for="password" class="block text-sm font-semibold text-gray-700">New Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-1">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>

                    <!-- Actions -->
                    <div class="pt-2 flex justify-end gap-3">
                        <a href="{{ route('interns.index') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg shadow-sm">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                            Update Intern
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
