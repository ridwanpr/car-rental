@extends('layouts.backend.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="container max-w-5xl mx-auto">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h4 mb-1 text-gray-900 font-weight-bold">Ticket Discussion</h1>
                        <p class="text-muted mb-0 d-flex align-items-center gap-2">
                            <span class="fw-medium">#{{ $ticket->id }}</span>
                            <span class="small">•</span>
                            <span>{{ $ticket->subject }}</span>
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span
                            class="px-3 py-1 rounded-pill fw-medium fs-7 {{ $ticket->status == 'open'
                                ? 'bg-success-subtle text-success'
                                : ($ticket->status == 'in_progress'
                                    ? 'bg-warning-subtle text-warning'
                                    : 'bg-danger-subtle text-danger') }}">
                            {{ ucfirst($ticket->status) }}
                        </span>
                        <a href="{{ route('ticket.index') }}" class="btn btn-light btn-sm px-3">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </div>
            </div>

            <!-- Chat Section -->
            <div class="bg-white rounded-lg shadow-sm">
                <!-- Messages Area -->
                <div class="chat-messages p-4" id="messageContainer" style="height: 65vh; overflow-y: auto;">
                    @foreach ($messages as $message)
                        <div class="chat-message mb-4 {{ $message->user_id === auth()->id() ? 'ms-auto' : 'me-auto' }}"
                            style="max-width: 85%;">
                            <div
                                class="d-flex flex-column {{ $message->user_id === auth()->id() ? 'align-items-end' : 'align-items-start' }}">
                                <small class="text-muted mb-1">{{ $message->user->name }}</small>
                                <div class="message-content">
                                    <div
                                        class="p-3 rounded-3 {{ $message->user_id === auth()->id() ? 'bg-primary bg-gradient text-white' : 'bg-light border' }}">
                                        {{ $message->message }}
                                    </div>
                                    <small class="text-muted d-block mt-1">
                                        {{ $message->created_at->format('M d, Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Input Area -->
                <div class="border-top p-4">
                    @if ($ticket->status !== 'closed')
                        <form id="messageForm" class="d-flex gap-3">
                            @csrf
                            <div class="flex-grow-1 position-relative">
                                <textarea class="form-control border-0 bg-light resize-none" id="newMessage" rows="2"
                                    placeholder="Type your message..." style="border-radius: 1rem;"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 0.8rem;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    @else
                        <div class="alert alert-warning d-flex align-items-center gap-2 mb-0">
                            <i class="fas fa-lock"></i>
                            <span>This ticket is closed. No new messages can be sent.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .fs-7 {
            font-size: 0.875rem;
        }

        .chat-messages::-webkit-scrollbar {
            width: 6px;
        }

        .chat-messages::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .chat-messages::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }

        .chat-messages::-webkit-scrollbar-thumb:hover {
            background: #bbb;
        }

        .resize-none {
            resize: none;
        }

        textarea:focus {
            box-shadow: none !important;
        }
    </style>
@endpush
@push('js')
    @vite('resources/js/echo.js')
    <script type="module">
        $(document).ready(function() {
            const ticketId = '{{ $ticket->id }}';
            const messageForm = $('#messageForm');
            const messageContainer = $('#messageContainer');
            const newMessage = $('#newMessage');

            messageContainer.scrollTop(messageContainer[0].scrollHeight);

            Echo.private(`ticket.${ticketId}`)
                .listen('NewTicketMessage', (event) => {
                    console.log('New Ticket Message:', event.message);

                    if (event.message && event.message.user_id && event.message.message) {
                        appendMessage(event.message);
                    } else {
                        console.error('Invalid message data received:', event.message);
                    }
                });

            newMessage.on('keydown', function(e) {
                if (e.ctrlKey && e.key === 'Enter') {
                    e.preventDefault();
                    messageForm.submit();
                }
            });

            messageForm.on('submit', function(e) {
                e.preventDefault();

                const message = newMessage.val().trim();
                if (!message) return;

                $.ajax({
                    url: `/ticket-request/${ticketId}/messages`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        message: message
                    },
                    success: function(data) {
                        appendMessage(data.message);
                        newMessage.val('');
                    },
                    error: function(xhr, status, error) {
                        const errorData = xhr.responseJSON;
                        console.error('Error:', errorData.message || 'Something went wrong');
                        alert(errorData.message || 'Something went wrong');
                    }
                });
            });

            function appendMessage(message) {
                if (!message || !message.user_id) {
                    console.error('Message object or user_id is missing.');
                    return;
                }

                const isOwnMessage = message.user_id === {{ auth()->id() }};
                const messageElement = $('<div>', {
                    class: `chat-message mb-4 ${isOwnMessage ? 'ms-auto' : 'me-auto'}`,
                    css: {
                        maxWidth: '85%'
                    }
                });

                const messageContent = `
                    <div class="d-flex flex-column ${isOwnMessage ? 'align-items-end' : 'align-items-start'}">
                        <small class="text-muted mb-1">${message.user.name}</small>
                        <div class="message-content">
                            <div class="p-3 rounded-3 ${isOwnMessage ? 
                                'bg-primary bg-gradient text-white' : 
                                'bg-light border'}">
                                ${message.message}
                            </div>
                            <small class="text-muted d-block mt-1">
                                ${new Date(message.created_at).toLocaleString()}
                            </small>
                        </div>
                    </div>
                `;

                messageElement.html(messageContent);
                messageContainer.append(messageElement);
                messageContainer.scrollTop(messageContainer[0].scrollHeight);
            }
        });
    </script>
@endpush
