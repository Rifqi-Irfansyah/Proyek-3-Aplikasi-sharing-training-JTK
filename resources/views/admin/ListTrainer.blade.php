@extends('../layoutmaster')

@section('title', 'List Trainer')

@section('content')

@include('admin.topbar')

<!-- Custom Styling -->
<style>
    body {
        background-color: #f3f9ff;
    }
    h1 {
        font-weight: bold;
        font-family: 'Arial', sans-serif;
        color: #333;
    }
    .form-select, .form-group label {
        font-size: 1.1rem;
        color: #555;
    }
    .table {
        border-collapse: separate;
        border-spacing: 0 10px;
    }
    .table th {
        background-color: #004080; /* Warna background header tabel */
        color: white;
        border: none;
        font-size: 1.1rem;
    }
    .table td {
        background-color: white;
        border: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .table tr:hover td {
        transform: scale(1.03); /* Slight scaling effect */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); /* Stronger shadow */
        background-color: #f0faff; /* Slight background color change */
    }
    .age-badge {
        background-color: #e6f7ff;
        border-radius: 15px;
        padding: 0.4em 0.8em;
        color: #007bff;
        font-weight: bold;
    }
</style>

<!-- Title -->
<div class="container mt-5 text-center">
    <h1>List Trainer</h1>
</div>

<!-- Sort By Dropdown -->
<div class="container d-flex justify-content-start mt-3">
    <div class="form-group">
        <label for="sortBy" class="me-2">Sort By</label>
        <select class="form-select" id="sortBy">
            <option selected>Nama</option>
            <option value="Status Akun">Status Akun</option>
            <option value="Email">Email</option>
        </select>
    </div>
</div>

<!-- Main Container -->
<div class="container d-flex justify-content-center align-items-center mt-4">
    <div class="row justify-content-center w-100">
        <!-- Table -->
        <div class="col-md-10">
            <table class="table table-borderless text-center">
                <thead class="table-primary"> <!-- Tambahkan kelas table-primary di sini -->
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Tanggal Lahir</th>
                        <th>Status Akun</th> <!-- Tambahkan kolom Status Akun -->
                    </tr>
                </thead>
                <tbody>
                @foreach ($trainers as $tr)
                    <tr>
                        <td>{{ $tr->email }}</td>
                        <td>{{ $tr->user->name }}</td> <!-- Nama diambil dari relasi user -->
                        <td>{{ $tr->user->gender }}</td> <!-- Gender diambil dari relasi user -->
                        <td>{{ $tr->user->tanggal_lahir }}</td> <!-- Tanggal lahir diambil dari relasi user -->
                        <td>{{ $tr->status_akun }}</td> <!-- Status Akun diambil dari model tambahan_trainer -->
                    </tr>
                @endforeach  
                </tbody>
            </table>
        </div>
    </div>  
</div>

@include('footer')

@endsection
