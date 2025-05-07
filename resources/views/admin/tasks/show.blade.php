<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Task Details</h2>

                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Title:</h3>
                        <p class="text-gray-900 text-base">{{ $task->title }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Description:</h3>
                        <p class="text-gray-900 text-base">{{ $task->description }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Status:</h3>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                            @if($task->status === 'completed') bg-green-100 text-green-800
                            @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ str_replace('_', ' ', ucfirst($task->status)) }}
                        </span>
                    </div>
                    <!-- Comments Section -->
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Comments</h3>
                        
                        <!-- Comment Form -->
                        <form action="{{ route('tasks.comments.store', $task) }}" method="POST" class="mb-6">
                            @csrf
                            <div class="mb-4">
                                <textarea name="content" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Add a comment..."></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Post Comment
                                </button>
                            </div>
                        </form>

                        <!-- Comments List -->
                        <div class="space-y-4">
                            @foreach($task->comments()->latest()->get() as $comment)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center">
                                          
                                            <span class="text-sm font-medium text-gray-900">{{ $comment->user->name }}</span>
                                            <span class="text-sm text-gray-500 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                                            
                                        </div>
                                        @if(Auth::id() === $comment->user_id || Auth::user()->admin)
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <p class="mt-2 text-sm text-gray-700">{{ $comment->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('tasks.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Back to Tasks
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
