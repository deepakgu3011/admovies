@extends('layouts.app')
@section('content')
    <h1>Contact Users Details</h1>
    <div class="container2">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-borderless table-primary align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Sr no.</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($contacts as $contact)
                        <tr class="table-primary">
                            <td scope="row">{{ $count++ }}</td>
                            <td scope="row">{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->message }}</td>
                            <td><a href="#" onclick="reply('{{ $contact->email }}')">Reply<i class="fa fa-mail-reply" aria-hidden="true"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <caption>
                        Table Name
                    </caption>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Modal HTML -->
    <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">Reply To:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="replyForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="replyMessage">Message:</label>
                            <textarea class="form-control" id="replyMessage" name="replyMessage" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function reply(email) {
            $('#replyModalLabel').text('Reply To: ' + email); // Set the email in the modal title
            $('#replyModal').modal('show'); // Show the modal

            // Submit form via AJAX
            $('#replyForm').submit(function(event) {
                event.preventDefault();
                var replyMessage = $('#replyMessage').val();

                $.ajax({
                    url: '{{ route("sendReply") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: email,
                        replyMessage: replyMessage
                    },
                    success: function(response) {
                        console.log(response); // Log response for debugging
                        $('#replyModal').modal('hide'); // Hide the modal on success
                        Swal.fire("Reply sent!", "", "success");
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        if (xhr.status === 422) {
                            var errors = JSON.parse(xhr.responseText).errors;
                            var errorMessage = "Failed to send reply. Errors:\n";
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessage += errors[key] + "\n";
                                }
                            }
                            Swal.fire("Error!", errorMessage, "error");
                        } else {
                            Swal.fire("Error!", "Failed to send reply.", "error");
                        }
                    }
                });
            });
        }
    </script>
@endsection
