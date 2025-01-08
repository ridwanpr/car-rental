@extends('layouts.frontend.app')
@section('content')
    <div class="container py-5 min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create New Ticket</h1>
            <a href="{{ route('ticket.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Tickets
            </a>
        </div>

        <!-- Navigation -->
        @include('layouts.frontend.components.nav')

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <form id="ticketForm" action="{{ route('ticket.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                    id="subject" name="subject" required value="{{ old('subject') }}">
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Initial Message</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4"
                                    required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Create Ticket
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Interface (Shows up after ticket creation) -->
        <div id="chatInterface" class="mt-4 d-none">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h5 class="mb-0" id="ticketSubject"></h5>
                    <small class="text-muted" id="ticketStatus"></small>
                </div>
                <div class="card-body">
                    <div class="chat-messages p-4" id="messageContainer" style="height: 400px; overflow-y: auto;">
                        <!-- Messages will be loaded here -->
                    </div>

                    <div class="chat-input mt-4">
                        <form id="messageForm" class="d-flex gap-2">
                            <input type="hidden" id="ticketId" name="ticket_id">
                            <textarea class="form-control" id="newMessage" rows="2" placeholder="Type your message..."></textarea>
                            <button type="submit" class="btn btn-primary align-self-end">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ticketForm = document.getElementById('ticketForm');
    const chatInterface = document.getElementById('chatInterface');
    const messageForm = document.getElementById('messageForm');
    const messageContainer = document.getElementById('messageContainer');

    const reverb = new Reverb({
        host: '{{ config('reverb.host') }}:{{ config('reverb.port') }}',
        key: '{{ config('reverb.key') }}'
    });

    ticketForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        try {
            const response = await fetch(ticketForm.action, {
                method: 'POST',
                body: new FormData(ticketForm),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            const data = await response.json();
            
            if (data.success) {
                document.getElementById('ticketId').value = data.ticket.id;
                document.getElementById('ticketSubject').textContent = data.ticket.subject;
                document.getElementById('ticketStatus').textContent = `Status: ${data.ticket.status}`;
                
                ticketForm.classList.add('d-none');
                chatInterface.classList.remove('d-none');
                
                initializeReverbConnection(data.ticket.id);
            }
        } catch (error) {
            console.error('Error creating ticket:', error);
        }
    });

    function initializeReverbConnection(ticketId) {
        const channel = reverb.subscribe(`private-ticket.${ticketId}`);
        
        channel.listen('NewTicketMessage', (event) => {
            appendMessage(event.message);
        });
    }

    messageForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const ticketId = document.getElementById('ticketId').value;
        const message = document.getElementById('newMessage').value;
        
        try {
            const response = await fetch(`/tickets/${ticketId}/messages`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message })
            });

            if (response.ok) {
                document.getElementById('newMessage').value = '';
            }
        } catch (error) {
            console.error('Error sending message:', error);
        }
    });

    function appendMessage(message) {
        const messageElement = document.createElement('div');
        messageElement.className = `chat-message ${message.user_id === {{ auth()->id() }} ? 'text-end' : ''}`;
        messageElement.innerHTML = `
            <div class="mb-3">
                <small class="text-muted">${message.user.name}</small>
                <div class="p-3 rounded ${message.user_id === {{ auth()->id() }} ? 'bg-primary text-white' : 'bg-light'}">
                    ${message.message}
                </div>
                <small class="text-muted">${new Date(message.created_at).toLocaleString()}</small>
            </div>
        `;
        
        messageContainer.appendChild(messageElement);
        messageContainer.scrollTop = messageContainer.scrollHeight;
    }
});
</script>
@endpush
