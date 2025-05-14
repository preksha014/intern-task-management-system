<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Your Notifications</h2>
                        
                        @if($notifications->count() > 0)
                            <div class="flex space-x-4">
                                <form action="{{ route('notifications.markAllAsRead') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-sm text-blue-500 hover:text-blue-700 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Mark all as read
                                    </button>
                                </form>
                                
                                <!-- <button type="button"
                                                    class="text-sm text-red-500 hover:text-red-700 flex items-center"
                                                    data-action-open data-url="{{ route('notifications.destroyAll') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete All
                                </button> -->
                                <!-- <form action="{{ route('notifications.destroyAll') }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete all notifications?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-500 hover:text-red-700 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete all
                                    </button>
                                </form> -->
                                <form action="{{ route('notifications.destroyAll') }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                    <button type="submit">Delete All</button>
                                </form>
                            </div>
                        @endif
                    </div>

                    @if($notifications->count() > 0)
                        <div class="space-y-4">
                            @foreach($notifications as $notification)
                                <div class="p-4 {{ $notification->read_at ? 'bg-gray-100' : 'bg-blue-50' }} rounded-lg border {{ $notification->read_at ? 'border-gray-200' : 'border-blue-200' }}">
                                    <div class="flex justify-between">
                                        <div class="font-semibold {{ $notification->read_at ? 'text-gray-700' : 'text-blue-700' }}">
                                            {{ $notification->data['message'] }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <p class="text-sm font-medium">Tasks:</p>
                                        <ul class="list-disc list-inside ml-2 mt-1">
                                            @foreach($notification->data['tasks'] as $task)
                                                <li class="text-sm">{{ $task['task_title'] }}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="mt-3 flex justify-between items-center">
                                        <a href="{{ route('intern.tasks.index') }}" class="text-sm text-blue-500 hover:text-blue-700 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View Tasks
                                        </a>
                                        
                                        <div class="flex space-x-3">
                                            @if(!$notification->read_at)
                                                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Mark as read
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <button type="button"
                                                    class="text-sm text-red-500 hover:text-red-700 flex items-center"
                                                    data-action-open data-url="{{ route('notifications.destroy', $notification) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-lg p-8 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <p class="text-gray-600">You have no notifications at this time.</p>
                        </div>
                    @endif
                </div>
                    <!-- Delete Confirmation Modal -->
                    <div id="deleteModal"
                        class="fixed inset-0 bg-black/50 bg-opacity-50 flex items-center justify-center hidden">
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <h2 class="text-xl font-semibold mb-4">Are you sure?</h2>
                            <p class="text-gray-600">Do you really want to delete this notification? This action cannot be
                                undone.</p>
                            <div class="mt-4 flex justify-end space-x-2">
                                <button id="cancelDelete"
                                    class="bg-gray-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-600 transition duration-200">
                                    Cancel
                                </button>
                                <form id="deleteForm" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600 transition duration-200">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="modal.js"></script>
    @endpush
</x-app-layout>