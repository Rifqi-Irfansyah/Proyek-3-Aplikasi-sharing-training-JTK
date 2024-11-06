@extends('../layoutmaster')

@section('title', 'Detail Trainer Approve')

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
        <p><strong>Nama Trainer:</strong> {{ $trainer->user->name }}</p>
        <p><strong>Email:</strong> {{ $trainer->user->email }}</p>
        <p><strong>Tanggal Lahir:</strong> {{ $trainer->user->tanggal_lahir }}</p>
        <p><strong>No Telepon:</strong> {{ $trainer->user->no_wa }}</p>
        <p><strong>Pengalaman:</strong> {{ $trainer->user->pengalaman }}</p>
        <p><strong>Kemampuan:</strong> {{ $trainer->user->kemampuan }}</p>
        <p id="status"><strong>Status:</strong> {{ $trainer->status_pengajuan }}</p>
        
        <div class="btn-group">
            <a href="#" class="btn btn-view" onclick="approveTrainer('{{ $trainer->email }}')">✔️ Terima</a>
            <a href="#" class="btn btn-delete" onclick="rejectTrainer('{{ $trainer->email }}')">❌ Tolak</a>
        </div>
    </div>
</div>

@include('footer')

@endsection

<script>
    function approveTrainer(email) {
    const confirmation = confirm('Apakah Anda yakin ingin menerima trainer ini?');
    
    if (confirmation) {
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
                    title: 'Trainer Diterima!',
                    text: 'Trainer telah berhasil diterima.',
                    showConfirmButton: false,
                    timer: 1000
                });
                document.getElementById('status').innerHTML = `<strong>Status:</strong> Diterima`;
                document.querySelector('.btn-group').style.display = 'none';
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan dalam menerima trainer.');
            }
        });
    }
}

function rejectTrainer(email) {
    const confirmation = confirm('Apakah Anda yakin ingin menolak trainer ini?');

    if (confirmation) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('approve-trainer-reject') }}",  // Sesuaikan dengan route yang benar
            method: 'POST',
            data: {
                email: email,
                status: 'Ditolak'  // Mengirim status 'Ditolak'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Trainer Ditolak!',
                        text: 'Trainer telah berhasil ditolak.',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    document.getElementById('status').innerHTML = `<strong>Status:</strong> Ditolak`;
                    document.querySelector('.btn-group').style.display = 'none';
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan dalam menolak trainer.');
            }
        });
    }
}
</script>