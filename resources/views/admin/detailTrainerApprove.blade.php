@extends('../layoutmaster')

@section('title', 'Detail Trainer Approve')

@section('content')
<div class="d-flex flex-column min-vh-100">
    <div class="flex-grow-1">
        @include('admin.topbar')

        <style>
            .card {
                width: 1200px;
                margin: 20px auto;
                padding: 30px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            .card p {
                font-size: 1.25rem;
                line-height: 1.5;
            }
            .card strong {
                font-size: 1.25rem;
            }
            .btn-group {
                margin-top: 20px;
            }
        </style>

        <div class="container mt-5">
            <h1>Detail Trainer</h1>
        </div>

        <div class="container">
            <div class="card" id="trainer-card-{{ $trainer->id }}">
                <p><strong>Trainer Name:</strong> {{ $trainer->user->name }}</p>
                <p><strong>Email:</strong> {{ $trainer->user->email }}</p>
                <p><strong>Date of Birth:</strong> {{ $trainer->user->tanggal_lahir }}</p>
                <p><strong>Phone Number:</strong> {{ $tambahanTrainer->no_wa }}</p>
                <p><strong>Experience:</strong> {{ $tambahanTrainer->pengalaman }}</p>
                <p><strong>Ability:</strong> {{ $tambahanTrainer->kemampuan }}</p>
                <p id="status"><strong>Status:</strong> {{ $trainer->status_pengajuan }}</p>
                
                <div class="btn-group">
                    <a href="#" class="btn btn-view" onclick="approveTrainer('{{ $trainer->email }}')">✔️ Accept</a>
                    <a href="#" class="btn btn-delete" onclick="rejectTrainer('{{ $trainer->email }}')">❌ Reject</a>
                </div>
            </div>
        </div>
        
        <div class="container">
        </div>
    </footer>
</div>

@include('footer')

@endsection

<script>
    const approveTrainerRoute = "{{ route('approvetrainer') }}";
    
    function approveTrainer(email) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Would you like to accept this trainer?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes, accept!',
            cancelButtonText: 'Cancelled',
            reverseButtons: true,
            backdrop: 'rgba(0,0,0,0.8)',
            customClass: {
                popup: 'popup-edit',
                confirmButton: 'btn-confirm',
                cancelButton: 'btn-cancel',
                title: 'title'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('approve-trainer-confirm') }}",
                    method: 'POST',
                    data: {
                        email: @json($trainer->email_trainer),
                        id_training: @json($trainer->id_training),
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Trainer successfully accepted',
                            timer: 2000,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'popup-success',
                                title: 'title'
                            }
                        }).then(() => {
                            window.location.href = approveTrainerRoute;
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred in accepting the trainer.',
                            customClass: {
                                popup: 'popup-error',
                                title: 'title'
                            }
                        });
                    }
                });
            }
        });
    }

    function rejectTrainer(email) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to reject this trainer?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, reject!',
            cancelButtonText: 'Cancelled',
            reverseButtons: true,
            backdrop: 'rgba(0,0,0,0.8)',
            customClass: {
                popup: 'popup-edit',
                confirmButton: 'btn-confirm',
                cancelButton: 'btn-cancel',
                title: 'title'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('approve-trainer-reject') }}",
                    method: 'POST',
                    data: {
                        email: @json($trainer->email_trainer),
                        id_training: @json($trainer->id_training),
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Trainer was successfully rejected',
                                timer: 2000,
                                showConfirmButton: false,
                                customClass: {
                                    popup: 'popup-success',
                                    title: 'title'
                                }
                            }).then(() => {
                                window.location.href = approveTrainerRoute;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                                customClass: {
                                    popup: 'popup-error',
                                    title: 'title'
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred in rejecting the trainer',
                            customClass: {
                                popup: 'popup-error',
                                title: 'title'
                            }
                        });
                    }
                });
            }
        });
    }
</script>