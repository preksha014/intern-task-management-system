<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden border border-gray-100">
                <div class="p-8">

                    <div class="flex justify-between items-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-900">Intern Dashboard</h1>
                        <div class="flex space-x-4">
                            <a href="{{ route('intern.tasks.index') }}"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Tasks
                            </a>
                            <a href="{{ route('intern.chat.index') }}"
                                class="inline-flex items-center px-6 py-3 bg-white border-2 border-blue-600 rounded-lg font-semibold text-sm text-blue-600 uppercase tracking-wider hover:bg-blue-50 active:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Chats
                            </a>
                        </div>
                    </div>

                    <!-- Welcome Card -->
                    <div class="bg-blue-100 rounded-xl shadow-sm p-6 mb-8 border border-blue-200">
                        <div class="flex items-center">
                            <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            <h2 class="text-2xl font-bold text-blue-900">Welcome, {{ $intern->user->name }}!</h2>
                        </div>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <!-- Intern Details Card -->
                        <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <h2 class="text-xl font-semibold text-gray-800">Intern Details</h2>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="text-gray-600 space-y-4">
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500">Name</p>
                                            <p class="font-medium text-gray-800">{{ $intern->user->name }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500">Email</p>
                                            <p class="font-medium text-gray-800">{{ $intern->user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500">Department</p>
                                            <p class="font-medium text-gray-800">{{ ucfirst($intern->department) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Assigned Tasks Card -->
                        <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <h2 class="text-xl font-semibold text-gray-800">Assigned Tasks</h2>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800 font-medium">
                                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                        Total: {{ $intern->tasks->count() }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                @if ($intern->tasks->isEmpty())
                                    <div class="text-center py-8 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No tasks</h3>
                                        <p class="mt-1 text-sm text-gray-500">No tasks have been assigned to you yet.</p>
                                    </div>
                                @else
                                    <div class="space-y-3">
                                        @foreach ($intern->tasks as $task)
                                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-150 border border-gray-100">
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-blue-600 mr-3"></div>
                                                    <span class="text-gray-700 font-medium">{{ $task->title }}</span>
                                                </div>
                                                <a href="{{ route('intern.tasks.show', $task) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-150">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    View
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>