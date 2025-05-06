@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <h4 class="card-title flex-grow-1">Contact Form Response</h4>
                                <div class="flex-shrink-0">
                                    <span class="badge bg-primary">Status: {{ $contact->status }}</span>
                                </div>
                            </div>

                            <!-- Original Message -->
                            <div class="border rounded p-4 mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15 mb-1">{{ $contact->name }}</h5>
                                        <p class="text-muted mb-0">{{ $contact->email }}</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="text-muted">{{ $contact->created_at->format('M d, Y h:i A') }}</span>
                                    </div>
                                </div>
                                <p class="text-dark mb-0">{{ $contact->message }}</p>
                            </div>

                            <!-- Message Thread -->
                            <!-- <div class="chat-thread mb-4" style="max-height: 400px; overflow-y: auto;">
                                @foreach($replies as $reply)
                                <div class="chat-message {{ $reply->is_admin ? 'admin-message' : 'user-message' }} mb-3">
                                    <div class="d-flex">
                                        @if($reply->is_admin)
                                        <div class="flex-grow-1 text-end">
                                            <div class="bg-primary text-white rounded p-3 d-inline-block">
                                                {{ $reply->message }}
                                            </div>
                                            <div class="text-muted small mt-1">
                                                {{ $reply->created_at->format('M d, Y h:i A') }}
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0 ms-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                    A
                                                </span>
                                            </div>
                                        </div>
                                        @else
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-soft-info text-info">
                                                    {{ substr($contact->name, 0, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="bg-light rounded p-3 d-inline-block">
                                                {{ $reply->message }}
                                            </div>
                                            <div class="text-muted small mt-1">
                                                {{ $reply->created_at->format('M d, Y h:i A') }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div> -->
                            <div class="chat-thread mb-4" style="max-height: 400px; overflow-y: auto;">
    @foreach($replies as $reply)
    <div class="chat-message {{ $reply->is_admin ? 'admin-message' : 'user-message' }} mb-3" 
         data-bs-toggle="modal" 
         data-bs-target="#messageModal{{ $reply->id }}">
        <div class="d-flex">
            @if($reply->is_admin)
            <div class="flex-grow-1 text-end">
                <div class="bg-primary text-white rounded p-3 d-inline-block">
                    {{ $reply->message }}
                </div>
                <div class="text-muted small mt-1">
                    {{ $reply->created_at->format('M d, Y h:i A') }}
                </div>
            </div>
            <div class="flex-shrink-0 ms-3">
                <div class="avatar-xs">
                    <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                        A
                    </span>
                </div>
            </div>
            @else
            <div class="flex-shrink-0 me-3">
                <div class="avatar-xs">
                    <span class="avatar-title rounded-circle bg-soft-info text-info">
                        {{ substr($contact->name, 0, 1) }}
                    </span>
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="bg-light rounded p-3 d-inline-block">
                    {{ $reply->message }}
                </div>
                <div class="text-muted small mt-1">
                    {{ $reply->created_at->format('M d, Y h:i A') }}
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Modal for this reply -->
    <div class="modal fade" id="messageModal{{ $reply->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $reply->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel{{ $reply->id }}">Message Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Date:</strong> <span>{{ $reply->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>Time:</strong> <span>{{ $reply->created_at->format('h:i A') }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>Subject:</strong> <span>{{ $reply->subject ?? 'No Subject' }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>Message:</strong> <p>{{ $reply->message }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>



                            <!-- Reply Form -->
                            <div class="border-top pt-4">
                                <form action="{{ route('admin.reply', $contact->id) }}" method="POST" id="replyForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                        <div class="mb-3">
                                        <input type="hidden"  name="name" rows="3" value="{{$contact->name}}"/>

                                            <label>Subject</label>
                                                <input class="form-control" id="subject" name="subject" rows="3" placeholder="Type Subject"/>
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="user_email" value="{{ $contact->email }}">
                                                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Type your reply..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-paper-plane me-1"></i> Send Reply
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.chat-message {
    margin-bottom: 1.5rem;
}

.admin-message .bg-primary {
    max-width: 80%;
    border-radius: 15px 15px 0 15px;
}

.user-message .bg-light {
    max-width: 80%;
    border-radius: 15px 15px 15px 0;
}

.avatar-xs {
    height: 2.2rem;
    width: 2.2rem;
}

.avatar-title {
    align-items: center;
    display: flex;
    font-weight: 500;
    height: 100%;
    justify-content: center;
    width: 100%;
}
</style>





@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messageModal = document.getElementById('messageModal');
    
    // Use Bootstrap's modal show event to populate data
    messageModal.addEventListener('show.bs.modal', function(event) {
        // Get the element that triggered the modal
        const message = event.relatedTarget;
        
        // Extract data attributes
        const date = message.getAttribute('data-date') || 'N/A';
        const time = message.getAttribute('data-time') || 'N/A';
        const subject = message.getAttribute('data-subject') || 'N/A';
        const messageText = message.getAttribute('data-message') || 'N/A';
        
        // Debugging: Log data to console to verify
        console.log('Modal Data:', { date, time, subject, messageText });
        
        // Update modal content
        document.getElementById('modalDate').textContent = date;
        document.getElementById('modalTime').textContent = time;
        document.getElementById('modalSubject').textContent = subject;
        document.getElementById('modalMessage').textContent = messageText;
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll chat to bottom on load
    const chatThread = document.querySelector('.chat-thread');
    chatThread.scrollTop = chatThread.scrollHeight;

    // Form submission handling
    const replyForm = document.getElementById('replyForm');
    replyForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Append new message to chat
                const newMessage = createMessageElement(data.reply);
                chatThread.insertAdjacentHTML('beforeend', newMessage);
                
                // Clear form and scroll to bottom
                replyForm.reset();
                chatThread.scrollTop = chatThread.scrollHeight;
            }
        })
        .catch(error => console.error('Error:', error));
    });

    function createMessageElement(reply) {
        const timestamp = new Date(reply.created_at).toLocaleString();
        return `
            <div class="chat-message admin-message mb-3">
                <div class="d-flex">
                    <div class="flex-grow-1 text-end">
                        <div class="bg-primary text-white rounded p-3 d-inline-block">
                            ${reply.message}
                        </div>
                        <div class="text-muted small mt-1">
                            ${timestamp}
                        </div>
                    </div>
                    <div class="flex-shrink-0 ms-3">
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                A
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
});
</script>
@endpush
@endsection