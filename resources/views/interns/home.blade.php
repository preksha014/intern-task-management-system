<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex justify-between items-center border-b pb-4 mb-4">
                    <h1 class="text-3xl font-extrabold text-gray-900">Intern Dashboard</h1>
                    <a href="{{ route('intern.tasks.index') }}"
                       class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition">
                        View Tasks
                    </a>
                </div>

                <div class="space-y-6">
                    <!-- Welcome Card -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-900 p-4 rounded">
                        <p class="text-lg font-medium">Welcome, {{ $intern->user->name }}!</p>
                    </div>

                    <!-- Intern Details Card -->
                    <div class="bg-white shadow rounded-lg p-5 border border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Intern Details</h2>
                        <div class="text-gray-600 space-y-1">
                            <p><span class="font-medium">Name:</span> {{ $intern->user->name }}</p>
                            <p><span class="font-medium">Email:</span> {{ $intern->user->email }}</p>
                            <p><span class="font-medium">Department:</span> {{ ucfirst($intern->department) }}</p>
                        </div>
                    </div>

                    <!-- Assigned Tasks Card -->
                    <div class="bg-white shadow rounded-lg p-5 border border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Assigned Tasks</h2>
                        @if ($intern->tasks->isEmpty())
                            <p class="text-gray-500 italic">No tasks assigned.</p>
                        @else
                            <ul class="list-disc list-inside space-y-1 text-gray-700">
                                @foreach ($intern->tasks as $task)
                                    <li>{{ $task->title }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
