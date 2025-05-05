<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Intern Dashboard</h1>

            <!-- Display intern details and assigned tasks here -->
            <a href="{{ route('intern.tasks.index') }}">Tasks</a>

            <div class="mt-6 space-y-4">
                <!-- Example: Display a welcome message -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800">Welcome, {{ $intern->user->name }}!</h2>
                </div>

                <!-- Example: Display intern details -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800">Intern Details</h2>
                    <p class="text-gray-600">Name: {{ $intern->user->name }}</p>
                    <p class="text-gray-600">Email: {{ $intern->user->email }}</p>
                    <p class="text-gray-600">Department: {{ $intern->department }}</p>
                </div>

                <!-- Example: Display assigned tasks -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800">Assigned Tasks</h2>
                    @if ($intern->tasks->isEmpty())
                        <p class="text-gray-600">No tasks assigned.</p>
                    @else
                        <ul class="list-disc list-inside">
                            @foreach ($intern->tasks as $task)
                                <li class="text-gray-600">{{ $task->title }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>