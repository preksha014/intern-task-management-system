<x-dashboard-layout>
    <div>
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-xl p-8">
                <div class="mb-4 text-center">
                    <h2 class="text-xl font-bold text-gray-900">Assign Task to Intern</h2>
                    <p class="mt-1 text-sm text-gray-600">Choose an intern and assign relevant tasks</p>
                </div>

                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('interns.assign.store') }}" method="POST" id="assign-task-form" class="space-y-5">
                    @csrf

                    <!-- Intern Selection -->
                    <div class="space-y-1">
                        <label for="intern_id" class="block text-sm font-semibold text-gray-700">Select Intern</label>
                        <select name="intern_id" id="intern_id" required
                            class="w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <option value="">Select an intern</option>
                            @foreach($interns as $intern)
                                <option value="{{ $intern->id }}">{{ $intern->user->name }} - {{ $intern->department }}</option>
                            @endforeach
                        </select>
                        @error('intern_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Task Selection -->
                    <div class="space-y-1">
                        <label for="task_id" class="block text-sm font-semibold text-gray-700">Select Tasks</label>
                        <select name="task_id[]" id="task_id" multiple required
                            class="w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @foreach($tasks as $task)
                                <option value="{{ $task->id }}">{{ $task->title }} (Due: {{ $task->due_date->format('Y-m-d') }})</option>
                            @endforeach
                        </select>
                        @error('task_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="pt-2 flex justify-end gap-3">
                        <a href="{{ route('interns.index') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg shadow-sm">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                            Assign Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>