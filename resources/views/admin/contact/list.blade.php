@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Contact Us Submissions</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card energi-card">
                        <div class="card-body">
                            <!-- Filter Form -->
                            <form method="GET" action="{{ route('admin.contact-list') }}" class="mb-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}" placeholder="Enter name">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" value="{{ request('email') }}" placeholder="Enter email">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ request('phone') }}" placeholder="Enter phone">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="subject" class="form-label">Subject</label>
                                            <input type="text" class="form-control" id="subject" name="subject" value="{{ request('subject') }}" placeholder="Enter subject">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="date_from" class="form-label">Date From</label>
                                            <input type="date" class="form-control" id="date_from" name="date_from" value="{{ request('date_from') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="date_to" class="form-label">Date To</label>
                                            <input type="date" class="form-control" id="date_to" name="date_to" value="{{ request('date_to') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end">
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary me-2">Apply Filters</button>
                                            <a href="{{ route('admin.contact-list') }}" class="btn btn-secondary">Clear Filters</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <table id="datatable" class="table table-centered table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Contact Info</th>
                                            <th>Phone Number</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @forelse($contactList as $contact)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->subject }}</td>
                                            <td>{{ $contact->message }}</td>
                                            <td>{{ $contact->created_at->format('d F Y, h:i A') }}</td> 
                                            <td>
                                                @php
                                                $replied = DB::table('replied_emails')->where('contact_id', $contact->id)->first();
                                                @endphp
                                                @if($replied)
                                                    <button type="button" class="btn btn-success btn-sm view-reply-btn" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#viewReplyModal{{ $contact->id }}">Replied</button>                                               
                                                @else
                                                    <button type="button" class="btn btn-primary btn-sm reply-btn" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#replyModal{{ $contact->id }}">Reply</button>
                                                @endif
                                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this contact?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Reply Modal -->
                                        <div class="modal fade" id="replyModal{{ $contact->id }}" tabindex="-1" aria-labelledby="replyModalLabel{{ $contact->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="replyModalLabel{{ $contact->id }}">Reply to {{ $contact->name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                   div>
                                                    <form id="replyForm{{ $contact->id }}" action="{{ route('admin.contacts.reply', $contact->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="recipient-email{{ $contact->id }}" class="form-label">To</label>
                                                                <input type="email" class="form-control" id="recipient-email{{ $contact->id }}" value="{{ $contact->email }}" readonly>
                                                            </div>
                                                            <input name="contact_id" class="form-control" id="contact_id{{ $contact->id }}" value="{{ $contact->id }}" hidden>
                                                            <div class="mb-3">
                                                                <label for="subject{{ $contact->id }}" class="form-label">Subject</label>
                                                                <input type="text" class="form-control" id="subject{{ $contact->id }}" name="subject" value="Re: {{ $contact->subject }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message{{ $contact->id }}" class="form-label">Message</label>
                                                                <textarea class="form-control" id="message{{ $contact->id }}" name="message" rows="6" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Send Reply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- View Reply Modal -->
                                        <div class="modal fade" id="viewReplyModal{{ $contact->id }}" tabindex="-1" aria-labelledby="viewReplyModalLabel{{ $contact->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <dabody>
                                                        @if($replied)
                                                            <p><strong>Subject:</strong> {{ $replied->subject }}</p>
                                                            <p><strong>Message:</strong> {{ $replied->message }}</p>
                                                            <p><strong>Sent At:</strong> {{ \Carbon\Carbon::parse($replied->created_at)->format('d F Y, h:i A') }}</p>
                                                        @else
                                                            <p>No reply details available.</p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No contacts found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $contactList->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    // Handle reply form submission
    $('form[id^="replyForm"]').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var contactId = form.attr('id').replace('replyForm', '');
        var url = form.attr('action');
        var data = form.serialize();

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.success) {
                    // Close the reply modal
                    $('#replyModal' + contactId).modal('hide');
                    
                    // Replace Reply button with Replied button
                    var repliedButton = `<button type="button" class="btn btn-success btn-sm view-reply-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#viewReplyModal${contactId}">Replied</button>`;
                    form.closest('tr').find('.reply-btn').replaceWith(repliedButton);
                    
                    // Show success toast
                    showToast('Reply sent successfully!');
                } else {
                    showToast('Error sending reply.', 'error');
                }
            },
            error: function(xhr) {
                showToast('Failed to send reply. Please try again.', 'error');
            }
        });
    });

    // Custom toast notification
    function showToast(message, type = 'success') {
        var toast = $('<div>').css({
            position: 'fixed',
            top: '20px',
            right: '20px',
            padding: '15px',
            color: '#fff',
            background: type === 'success' ? '#28a745' : '#dc3545',
            borderRadius: '5px',
            zIndex: 1000,
            maxWidth: '300px'
        }).text(message);
        
        $('body').append(toast);
        setTimeout(function() {
            toast.fadeOut(300, function() { $(this).remove(); });
        }, 3000);
    }
});
</script>
@endsection