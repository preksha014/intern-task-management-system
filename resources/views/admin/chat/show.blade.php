<x-dashboard-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Chat Header -->
                <div class="p-4 border-b bg-white flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                            {{ strtoupper(substr($receiver->name, 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">{{ $receiver->name }}</h2>
                            <p class="text-sm text-gray-500">{{ $receiver->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.chat.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-300 focus:ring ring-gray-300 disabled:opacity-25 transition">
                        Back to Chats
                    </a>
                </div>

                <!-- Messages Container -->
                <div id="messages" class="h-[calc(100vh-280px)] overflow-y-auto p-4 space-y-4 bg-gray-50">
                    @foreach($messages as $message)
                        <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="flex items-end space-x-2 max-w-[70%]">
                                @if($message->sender_id !== auth()->id())
                                    <div
                                        class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($message->sender->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div
                                    class="{{ $message->sender_id === auth()->id() ? 'bg-blue-600 text-white' : 'bg-white text-gray-900' }} rounded-2xl px-4 py-2 shadow-sm">
                                    <p class="text-sm">{{ $message->content }}</p>
                                    <span
                                        class="text-xs block mt-1 {{ $message->sender_id === auth()->id() ? 'text-blue-100' : 'text-gray-500' }}">
                                        {{ $message->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Message Input -->
                <div class="p-4 border-t bg-white">
                    <form id="messageForm" class="flex space-x-2" action="{{ route('admin.chat.send', $receiver->id) }}"
                        method="POST">
                        @csrf
                        <input type="text" name="content"
                            class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Type your message...">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 disabled:opacity-25 transition">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const senderId = {{ auth()->id() }};
            const recipientId = {{ $receiver->id }};
            const messagesDiv = document.getElementById('messages');
            const form = document.getElementById('messageForm');
            const contentInput = form.querySelector('input[name="content"]');
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Send Message via Fetch
            form.addEventListener('submit', async function (e) {
                e.preventDefault();
                const content = contentInput.value.trim();
                if (!content) return;

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ content })
                    });

                    const data = await response.json();
                    if (data.status === 'success') {
                        const div = document.createElement('div');
                        div.className = 'flex justify-end';
                        div.innerHTML = `
                        <div class="bg-blue-500 text-white rounded-lg px-4 py-2 max-w-sm">
                            <p class="text-sm">${data.data.content}</p>
                            <span class="text-xs block mt-1 text-blue-100">Just now</span>
                        </div>
                    `;
                        messagesDiv.appendChild(div);
                        messagesDiv.scrollTop = messagesDiv.scrollHeight;
                        contentInput.value = '';
                    } else {
                        alert('Error sending message');
                    }
                } catch (error) {
                    console.error(error);
                    alert('Something went wrong.');
                }
            });

            window.Echo.channel(`chat.${recipientId}.${senderId}`)
                .listen('.MessageSent', (e) => {
                    const div = document.createElement('div');
                    div.className = 'flex justify-start';
                    div.innerHTML = `
                    <div class="bg-gray-200 text-black rounded-lg px-4 py-2 max-w-sm">
                        <p class="text-sm">${e.message.content}</p>
                        <span class="text-xs block mt-1 text-gray-500">Just now</span>
                    </div>
                `;
                    messagesDiv.appendChild(div);
                    messagesDiv.scrollTop = messagesDiv.scrollHeight;
                });
        });
    </script>
</x-dashboard-layout>