@extends('../layoutmaster')

@section('title', 'Detail Trainer')

@section('content')

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
        <p><strong>Email:</strong> {{ $trainer->email }}</p>
        <p><strong>Date of Birth:</strong> {{ $trainer->user->tanggal_lahir }}</p>
        <p><strong>Phone Number:</strong> {{ $trainer->no_wa }}</p>
        <p><strong>Experience:</strong> {{ $trainer->pengalaman }}</p>
        <p><strong>Ability:</strong> {{ $trainer->kemampuan }}</p>
        
        <div class="btn-group">
            <a href="#" class="btn btn-view" onclick="updateStatus('{{ $trainer->email }}')">✔️ Verification</a>
            <a href="#" class="btn btn-delete" onclick="update2Status('{{ $trainer->email }}')">❌ Reject</a>
        </div>
    </div>
</div>

@include('footer')

<script>
    if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false,
            customClass: {
                popup: 'popup-success',
                title: 'title',
            }
        });
    endif

    function updateStatus(email) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to verify this trainer?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes,verify!',
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
                    url: "{{ route('verif-trainer') }}",
                    method: 'POST',
                    data: {
                        email: email,
                        status: 'Terkonfirmasi'
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Processing...',
                            text: 'System sending email',
                            allowOutsideClick: false,
                            customClass: {
                                popup: 'popup-edit',
                                title: 'title'
                            },
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Trainer has been successfully verified',
                                timer: 2000,
                                showConfirmButton: false,
                                customClass: {
                                    popup: 'popup-success',
                                    title: 'title'
                                }
                            }).then(() => {
                                window.location.href = "{{ route('verifTrainer') }}";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Fail!',
                                text: response.message,
                                customClass: {
                                    popup: 'popup-edit',
                                    title: 'title'
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'There is an error',
                            text: 'Failed to verify trainer',
                            customClass: {
                                popup: 'popup-edit',
                                title: 'title'
                            }
                        });
                    }
                });
            }
        });
    }

    function update2Status(email) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to reject this trainer?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Reject!',
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
                    url: "{{ route('verif-trainer-delete') }}",
                    method: 'POST',
                    data: {
                        email: email,
                        status: 'Ditolak'
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Processing...',
                            text: 'System sending email',
                            allowOutsideClick: false,
                            customClass: {
                                popup: 'popup-edit',
                                title: 'title'
                            },
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
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
                                window.location.href = "{{ route('verifTrainer') }}";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Fail!',
                                text: response.message,
                                customClass: {
                                    popup: 'popup-edit',
                                    title: 'title'
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'There is an error',
                            text: 'Failed to reject the trainer',
                            customClass: {
                                popup: 'popup-edit',
                                title: 'title'
                            }
                        });
                    }
                });
            }
        });
    }
</script>