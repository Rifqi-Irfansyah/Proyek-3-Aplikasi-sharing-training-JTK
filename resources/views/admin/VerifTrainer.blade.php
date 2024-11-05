@extends('../layoutmaster')

@section('title', 'Verifikasi Trainer')

@section('content')

@include('admin.topbar')

<style>
    body {
        background-color: #e9f3fb;
    }
    h1 {
        font-weight: bold;
        font-family: 'Arial', sans-serif;
        color: #333;
        text-align: center;
        margin: 30px 0 30px;
        padding-bottom: 10px;
    }
    .table-container {
        width: 50%; /* Lebar lebih kecil */
        margin: 0 auto;
        margin: 30px 0 50px;
        padding-bottom: 20px;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Added shadow for depth */
        border-radius: 10px;
        overflow: hidden;
    }
    .table th, .table td {
        padding: 8px 10px; /* Reduced padding for tighter spacing */
        text-align: center;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        font-size: 16px; /* Standard font size */
    }
    .table th {
        background-color: #91c3f2;
        font-weight: bold; /* Bold text for header */
        background-color: #91c3f2;
    }
    .table td {
        background-color: white;
        transition: background-color 0.3s; /* Smooth transition for hover effect */
        background-color: white;
    }
    .table tr:hover td {
        background-color: #f1f7fc; /* Highlight row on hover */
    }
    .btn {
        padding: 8px 12px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        font-size: 14px;
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
    .table th:nth-child(1), .table td:nth-child(1) {
        width: 30%; /* Lebar kolom "Trainer Email" */
    }

    .table th:nth-child(2), .table td:nth-child(2) {
        width: 30%; /* Lebar kolom "Trainer Name" */
    }

    .table th:nth-child(3), .table td:nth-child(3) {
        width: 20%; /* Lebar kolom "No Telepon" */
    }

    .table th:nth-child(4), .table td:nth-child(4) {
        width: 20%; /* Lebar kolom "Actions" */
    }

</style>

<div class="container mt-5">
    <h1>Verifikasi Trainer</h1>
</div>

<div class="container table-container">
    <table class="table">
        <thead class="table-primary">
        <thead class="table-primary">
            <tr>
                <th>Trainer Email</th>
                <th>Trainer Name</th>
                <th>No Telepon</th>
                <th>Actions</th>
                <th>No Telfon</th>
                <th>Pengalaman</th>
                <th>Kemampuan</th>
                <th>Verifikasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trainers as $tr)
                @if($tr->status_akun === 'Belum direview')
                <tr>
                    <td>{{ $tr->email }}</td>
                    <td>{{ $tr->user->name }}</td>
                    <td>{{ $tr->no_wa }}</td>
                    <td>{{ $tr->user->name }}</td>
                    <td>{{ $tr->no_wa }}</td>
                    <td>{{ $tr->pengalaman }}</td>
                    <td>{{ $tr->kemampuan }}</td>
                    <td>
                        <div class="btn-group">
                            <!-- Only the View button -->
                            <a href="{{ route('view-trainer-detail', $tr->email) }}" class="btn btn-view">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </div>
                    </td>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

@include('footer')

@endsection
