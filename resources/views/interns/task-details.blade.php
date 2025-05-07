<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-lg sm:rounded-lg overflow-hidden">
                <div class="p-8">
                    @if (session('status'))
                        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-sm">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-900">Task Details</h1>
                        <a href="{{ route('intern.tasks.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Tasks
                        </a>
                    </div>

                    <div class="bg-white p-6 border border-gray-100">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $task->name }}</h2>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <span class="text-gray-500 font-medium w-24">Description:</span>
                                <p class="text-gray-700 flex-1">{{ $task->description }}</p>
                            </div>
                            <div class="flex items-center">
                                <span class="text-gray-500 font-medium w-24">Due Date:</span>
                                <p class="text-gray-700">{{ $task->due_date->format('F j, Y') }}</p>
                            </div>
                            <div class="flex items-center">
                                <span class="text-gray-500 font-medium w-24">Status:</span>
                                @if ($task->status === 'completed')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Completed</span>
                                @else
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">In Progress</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white shadow-lg sm:rounded-lg overflow-hidden mt-6">
                <div class="p-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Comments</h3>
                    <div class="space-y-4">
                        @forelse($task->comments as $comment)
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <p class="text-gray-700 text-lg">{{ $comment->content }}</p>
                                <div class="flex items-center mt-3 text-sm text-gray-500">
                                    <span class="font-medium text-gray-700">{{ $comment->user->name }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <p class="text-gray-500 text-lg">No comments yet.</p>
                                <p class="text-gray-400 text-sm mt-1">Be the first to share your thoughts!</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Comment Form -->
                    <div class="mt-8">
                        <form action="{{ route('tasks.comments.store', $task) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Add a comment</label>
                                <textarea
                                    name="content"
                                    id="content"
                                    rows="3"
                                    class="w-full px-4 py-3 text-gray-700 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                                    placeholder="Share your thoughts..."
                                ></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button
                                    type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150"
                                >
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Post Comment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</x-app-layout>