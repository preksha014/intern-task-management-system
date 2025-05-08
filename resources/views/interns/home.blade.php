<x-app-layout>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Intern Dashboard</h1>


                <!-- Restyled Tasks button positioned on the right -->
                <div class="flex space-x-4">
                    <a href="{{ route('intern.tasks.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Tasks
                    </a>
                    <a href="{{ route('intern.chat.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Chats
                    </a>
                </div>
            </div>

            <div class="mt-6 space-y-4">

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