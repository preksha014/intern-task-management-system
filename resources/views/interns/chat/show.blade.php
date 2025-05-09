<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg">
            <!-- Chat Header -->
            <div class="p-4 border-b flex items-center">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr($receiver->name, 0, 1)) }}
                    </div>
                    <h2 class="ml-3 text-xl font-semibold">{{ $receiver->name }}</h2>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('intern.chat.index') }}" class="text-blue-500 hover:text-blue-700">Back to Chats</a>
                </div>
            </div>

            <!-- Messages Container -->
            <div id="messages" class="h-96 overflow-y-auto p-4 space-y-4">
                @foreach($messages as $message)
                    <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="{{ $message->sender_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black' }} rounded-lg px-4 py-2 max-w-sm">
                            <p class="text-sm">{{ $message->content }}</p>
                            <span class="text-xs block mt-1 {{ $message->sender_id === auth()->id() ? 'text-blue-100' : 'text-gray-500' }}">
                                {{ $message->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Message Input -->
            <div class="p-4 border-t">
                <form id="messageForm" class="flex space-x-2" action="{{ route('intern.chat.send', $receiver->id) }}" method="POST">
                    @csrf
                    <input type="text" name="content" class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Type your message...">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Send</button>
                </form>
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

            // Listen to messages sent by the other user (admin)
            Echo.channel(`chat.${recipientId}.${senderId}`)
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
</x-app-layout>
