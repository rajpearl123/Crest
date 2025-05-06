@extends('web-views.layouts.app')
@php
$websiteSetting = App\Models\WebsiteSetting::first();
use App\Utils\ViewPath;
@endphp
@section('title', Auth::user()->name)
@section('content')
            <div class="container my-5">
                <div class="">
                    <!-- <div class="col-md-8"> -->
                        <div class="card">
                            <div class="card-header bg-white">
                                <h4 class="mb-0">Contact Form Replies</h4>
                                <div class="small text-muted">Ticket ID: #{{ $contact->id }}</div>
                            </div>

                            <div class="card-body">
                                <!-- Original Query -->
                                <div class="original-query mb-4">
                                    <div class="p-3 bg-light rounded">
                                        <div class="d-flex justify-content-between mb-2">
                                            <strong>Original Message</strong>
                                            <small class="text-muted">{{ $contact->created_at->format('d M, Y h:i A') }}</small>
                                        </div>
                                        <p class="mb-0">{{ $contact->message }}</p>
                                    </div>
                                </div>

                                <!-- Chat Messages -->
                                <div class="chat-box" id="chatBox" style="max-height: 500px; overflow-y: auto;">                        

                                    <!-- Combined and sorted messages -->
                                    @php
    $allMessages = collect()
        ->concat($messages)
        ->concat($adminMessages)
        ->sortBy('created_at');
                                    @endphp

                                    @foreach($allMessages as $message)
                                        @if($message->is_User == Auth::user()->id)
                                            <!-- User Message -->

                                            <div class="d-flex justify-content-end mb-3 user-message-block">
                                                <div class="message-bubble user-message">
                                                    <div class="p-3 rounded bg-primary text-white " >
                                                        <div class="message-content">{{ $message->message }}</div>

                                                    </div>
                                                    <div class="message-meta">
                                                        <small >{{ $message->created_at->format('d M, Y h:i A') }}</small>
                                                    </div>
                                                </div>
                                                <div class="avatar-xs user-reply-message">
                                                    <span class="avatar-title rounded-circle bg-soft-info">
                                                        {{ substr($contact->name, 0, 1) }}
                                                    </span>
                                                </div>
                                            </div>
                                        @else
                                            <!-- Admin Reply -->

                                            <div class="d-flex justify-content-start mb-3 user-message-block">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-xs admin-reply-message">
                                                        <span class="avatar-title rounded-circle bg-soft-info ">
                                                            {{ substr('P', 0, 1) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="message-bubble admin-message">
                                                    <div class="p-3 rounded message-block">
                                                        <div class="message-content">{{ $message->message }}</div>

                                                    </div>
                                                    <div class="message-meta">
                                                        <small class="text-muted">{{ $message->created_at->format('d M, Y h:i A') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <!-- Message Input -->
                                <form action="{{ route('sendReply', $contact->id) }}" method="POST" id="replyForm" class="mt-4">
                                    @csrf
                                    <div class="input-group send-message-block">
                                        <input type="hidden" name="user_email" value="{{Auth::user()->email}}">
                                        <textarea name="message" class="form-control" placeholder="Type your message..." required rows="2"></textarea>
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-paper-plane"></i> 
                                        </button>
                                    </div>
                                    @error('message')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </form>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>

            <style>
            /* .message-bubble {
                max-width: 70%;
            } */

            .message-content {
                word-wrap: break-word;
            }

            .chat-box {
                scroll-behavior: smooth;
            }

            .user-message .message-meta {
                text-align: right;
            }

            .original-query {
                border-left: 4px solid #007bff;
            }
            </style>

            @push('scripts')
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Scroll to bottom of chat on load
                const chatBox = document.getElementById('chatBox');
                chatBox.scrollTop = chatBox.scrollHeight;

                // Handle form submission
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
                            // Add new message to chat
                            const messageHtml = `
                                <div class="d-flex justify-content-end mb-3">
                                    <div class="message-bubble user-message">
                                        <div class="p-3 rounded bg-primary text-white" style="max-width: 70%;">
                                            <div class="message-content">${data.message.message}</div>
                                            <div class="message-meta">
                                                <small class="text-light">${new Date(data.message.created_at).toLocaleString()}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            chatBox.insertAdjacentHTML('beforeend', messageHtml);

                            // Clear form and scroll to bottom
                            replyForm.reset();
                            chatBox.scrollTop = chatBox.scrollHeight;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to send message. Please try again.');
                    });
                });

                // Auto-expand textarea
                const textarea = replyForm.querySelector('textarea');
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            });
            </script>
            @endpush
@endsection