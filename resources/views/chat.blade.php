<x-app-layout>
    <div class="container">
        <h1>Chat</h1>
        <div class="row">
            <div class="col-md-4">
                <h3>{{ auth()->user()->role === 'admin' ? 'Interns' : 'Admins' }}</h3>
                <ul class="list-group">
                    @foreach($users as $user)
                        <li class="list-group-item {{ $user->id === request('selected_user') ? 'active' : '' }}">
                            <a href="{{ route('chat.index', ['selected_user' => $user->id]) }}" class="text-decoration-none {{ $user->id === request('selected_user') ? 'text-white' : 'text-dark' }}">
                                {{ $user->name }} ({{ $user->role }})
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8">
                <h3>Messages</h3>
                <div id="messages" style="height: 400px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;">
                    @foreach($messages as $msg)
                        <div class="message mb-2 p-2 rounded {{ $msg->sender_id === auth()->id() ? 'bg-primary text-black ml-auto' : 'bg-light' }}" style="max-width: 70%;">
                            <div class="font-weight-bold">{{ $msg->sender->name }}</div>
                            <div>{{ $msg->content }}</div>
                            <small class="text-{{ $msg->sender_id === auth()->id() ? 'light' : 'muted' }}">{{ $msg->created_at->diffForHumans() }}</small>
                        </div>
                    @endforeach
                </div>
                <form id="message-form" class="mt-3">
                    @csrf
                    <div class="form-group">
                        <label for="recipient_id">Send to:</label>
                        @if(auth()->user()->role === 'admin')
                            <select name="recipient_id" id="recipient_id" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id === request('selected_user') ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->role }})
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <select name="recipient_id" id="recipient_id" class="form-control" disabled>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" selected>{{ $user->name }} ({{ $user->role }})</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="recipient_id" value="{{ $users->first()->id ?? '' }}">
                        @endif
                    </div>
                    <div class="form-group">
                        <textarea name="content" id="content" class="form-control"
                            placeholder="Type your message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>

<script>
    const messagesDiv = document.getElementById('messages');
    messagesDiv.scrollTop = messagesDiv.scrollHeight;

    function createMessageElement(message, isCurrentUser) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message mb-2 p-2 rounded ${isCurrentUser ? 'bg-primary text-white ml-auto' : 'bg-light'}`;
        messageDiv.style.maxWidth = '70%';

        const senderDiv = document.createElement('div');
        senderDiv.className = 'font-weight-bold';
        senderDiv.textContent = message.sender.name;

        const contentDiv = document.createElement('div');
        contentDiv.textContent = message.content;

        const timeDiv = document.createElement('small');
        timeDiv.className = `text-${isCurrentUser ? 'light' : 'muted'}`;
        timeDiv.textContent = 'Just now';

        messageDiv.appendChild(senderDiv);
        messageDiv.appendChild(contentDiv);
        messageDiv.appendChild(timeDiv);

        return messageDiv;
    }

    window.addEventListener('load', function() {
        if (typeof window.Echo === 'undefined') {
            console.error('Echo is not initialized');
            return;
        }

        Echo.private(`chat.{{ Auth::id() }}`)
            .listen('.message.sent', function (e) {
                const isCurrentUser = e.message.sender_id === {{ Auth::id() }};
                const messageElement = createMessageElement(e.message, isCurrentUser);
                messagesDiv.appendChild(messageElement);
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            });
    });

    document.getElementById('message-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const recipientId = document.querySelector('input[name="recipient_id"]')?.value || document.getElementById('recipient_id').value;
        const contentInput = document.getElementById('content');
        const content = contentInput.value.trim();

        if (!content) return;

        axios.post('{{ route('chat.send') }}', {
            recipient_id: recipientId,
            content: content,
        }).then(response => {
            const message = response.data.data;
            const messageElement = createMessageElement(message, true);
            messagesDiv.appendChild(messageElement);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
            contentInput.value = '';
        }).catch(error => {
            console.error(error);
            alert('Failed to send message. Please try again.');
        });
    });
</script>
</x-app-layout>