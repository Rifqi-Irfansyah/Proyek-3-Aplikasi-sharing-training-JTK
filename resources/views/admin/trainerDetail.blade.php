@extends('../layoutmaster')

@section('title', 'Detail Trainer')

@section('content')

@include('admin.topbar')

<style>
    .card {
        width: 1200px; /* Atur lebar sesuai kebutuhan */
        margin: 20px auto; /* Margin atas-bawah 20px, margin kiri-kanan auto untuk memusatkan */
        padding: 30px; /* Padding dalam kartu */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan untuk tampilan lebih menarik */
    }

    .card p {
        font-size: 1.25rem; /* Mengatur ukuran font untuk paragraf di dalam kartu */
        line-height: 1.5; /* Mengatur jarak antar baris untuk keterbacaan yang lebih baik */
    }

    .card strong {
        font-size: 1.25rem; /* Mengatur ukuran font untuk teks yang dicetak tebal */
    }

    .btn-group {
        margin-top: 20px; /* Jarak antara tombol dan konten atas */
    }
</style>

<div class="container mt-5">
    <h1>Detail Trainer</h1>
</div>

<div class="container">
    <div class="card" id="trainer-card-{{ $trainer->id }}">
        <p><strong>Nama Trainer:</strong> {{ $trainer->user->name }}</p>
        <p><strong>Email:</strong> {{ $trainer->email }}</p>
        <p><strong>Tanggal Lahir:</strong> {{ $trainer->user->tanggal_lahir }}</p>
        <p><strong>No Telepon:</strong> {{ $trainer->no_wa }}</p>
        <p><strong>Pengalaman:</strong> {{ $trainer->pengalaman }}</p>
        <p><strong>Kemampuan:</strong> {{ $trainer->kemampuan }}</p>
        
        <div class="btn-group">
            <a href="#" class="btn btn-view" onclick="updateStatus('{{ $trainer->email }}')">✔️ Verif</a>
            <a href="#" class="btn btn-delete" onclick="update2Status('{{ $trainer->email }}')">❌ Tolak</a>
        </div>
    </div>
</div>

@include('footer')

<script>
    function updateStatus(email) {
        // Menggunakan SweetAlert untuk konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Apakah Anda ingin mengonfirmasi trainer ini?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya, Konfirmasi!',
            cancelButtonText: 'Batal',
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
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Trainer Dikonfirmasi!',
                                text: 'Trainer telah berhasil dikonfirmasi.',
                                showConfirmButton: false,
                                timer: 1000
                            }).then(() => {
                                window.location.href = "{{ route('verifTrainer') }}"; // Redirect ke halaman verif-trainer
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal mengonfirmasi trainer.',
                        });
                    }
                });
            }
        });
    }

    function update2Status(email) {
        // Menggunakan SweetAlert untuk konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Apakah Anda ingin menolak trainer ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Tolak!',
            cancelButtonText: 'Batal',
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
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Trainer Ditolak!',
                                text: 'Trainer telah berhasil ditolak.',
                                showConfirmButton: false,
                                timer: 1000
                            }).then(() => {
                                window.location.href = "{{ route('verifTrainer') }}"; // Redirect ke halaman verif-trainer
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal menolak trainer.',
                        });
                    }
                });
            }
        });
    }
</script>
