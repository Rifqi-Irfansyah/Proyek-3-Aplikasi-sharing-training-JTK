@extends('../layoutmaster')

@section('title', 'Verifikasi Trainer')

@section('content')

@include('admin.topbar')

<!-- Custom Styling -->
<style>
    body {
        background-color: #e9f3fb; 
    }
    h1 {
        font-weight: bold;
        font-family: 'Arial', sans-serif;
        color: #333;
        text-align: center;
        margin: 30px 0 50px; 
        padding-bottom: 20px;
    }
    .table {
        width: 90%;
        margin: 0 auto;
        border-collapse: collapse;
        border-radius: 10px; 
        overflow: hidden; 
    }
    .table th, .table td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
    }
    .table th {
        background-color: #91c3f2; 
    }
    .table td {
        background-color: white; 
    }
    .table tr:hover {
        background-color: #f1f7fc;
    }
    .btn {
        padding: 5px 10px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        display: inline-block;
    }
    .btn-view {
        background-color: #17a2b8;
    }
    .btn-delete {
        background-color: #dc3545; 
    }
    .btn-view:hover {
        background-color: #138496;
    }
    .btn-delete:hover {
        background-color: #c82333;
    }
</style>

<!-- Title -->
<div class="container mt-5">
    <h1>Verifikasi Trainer</h1>
</div>

<!-- Main Container -->
<div class="container">
    <table class="table">
        <thead class="table-primary"> 
            <tr>
                <th>Trainer Email</th>
                <th>Trainer Name</th>
                <th>No Telfon</th>
                <th>Pengalaman</th>
                <th>Kemampuan</th> 
                <th>Verifikasi</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($trainers as $tr)
                @if($tr->status_akun != 'terkonfirmasi') 
                <tr>
                    <td>{{ $tr->email }}</td>
                    <td>{{ $tr->user->name }}</td> 
                    <td>{{ $tr->no_wa }}</td> 
                    <td>{{ $tr->pengalaman }}</td> 
                    <td>{{ $tr->kemampuan }}</td> 
                    <td>
                        <div class="btn-group">
                            <a href="#" class="btn btn-view" onclick="updateStatus('{{ $tr->email }}', '{{ $tr->status_akun }}')">✔️ Verif</a>
                            <a href="#" class="btn btn-delete" onclick="update2Status('{{ $tr->email }}','{{$tr->status_akun}}')">❌ Tolak</a>
                        </div>
                    </td> 
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

@include('footer')

<script>
    // Fungsi untuk mengonfirmasi trainer
    function updateStatus(email, status) {
        const confirmation = confirm('Apakah Anda yakin ingin mengonfirmasi trainer ini?');

        if (confirmation) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('verif-trainer') }}", // Route untuk konfirmasi trainer
                method: 'POST',
                data: {
                    email: email,
                    status: 'Terkonfirmasi'
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Trainer Dikonfirmasi!',
                            text: 'Trainer telah berhasil dikonfirmasi.',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan dalam mengonfirmasi trainer.');
                }
            });
        }
    }

    // Fungsi untuk menolak trainer
    function update2Status(email, status) {
        const confirmation = confirm('Apakah Anda yakin ingin menolak trainer ini?');

        if (confirmation) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('verif-trainer-delete') }}", // Route untuk menolak trainer
                method: 'POST',
                data: {
                    email: email,
                    status: 'Ditolak'
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Trainer Ditolak!',
                            text: 'Trainer telah berhasil ditolak.',
                            showConfirmButton: false,
                            timer: 1000
                        });
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

   

@endsection
