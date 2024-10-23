@extends('../layoutmaster')

@section('title', 'Approve Trainer')

@section('content')

<!-- Custom Styling -->
<style>
    body {
        background-color: #e9f3fb; /* Light blue background */
    }
    h1 {
        font-weight: bold;
        font-family: 'Arial', sans-serif;
        color: #333;
        text-align: center; /* Center align title */
        margin: 30px 0; /* Margin above and below the title */
    }
    .table {
        width: 90%; /* Set width for the table */
        margin: 0 auto; /* Center align the table */
        border-collapse: collapse; /* Collapse borders */
    }
    .table th {
        background-color: #276BF3; /* Header color */
        color: white; /* Header text color */
        padding: 10px; /* Padding for header */
        font-size: 1.1rem; /* Font size for header */
    }
    .table td {
        background-color: white; /* Cell background color */
        padding: 10px; /* Padding for cells */
        text-align: center; /* Center text in cells */
        border-bottom: 1px solid #ddd; /* Bottom border for rows */
    }
    .table tr:hover {
        background-color: #f1f7fc; /* Change background color on hover */
    }
    .see-detail {
        cursor: pointer; /* Show pointer cursor */
        color: #276BF3; /* Icon color */
    }
    .see-detail:hover {
        text-decoration: underline; /* Underline on hover */
    }
</style>

<!-- Title -->
<div class="container mt-5">
    <h1>Approve Trainer</h1>
</div>

<!-- Main Container -->
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Trainer Email</th>
                <th>Trainer Name</th>
                <th>No Telfon</th>
                <th>Pengalaman</th>
                <th>Status</th>
            </tr>
        </thead>
             @foreach ($trainers as $tr)
                <tr>
                    <td>{{ $tr->email }}</td>
                    <td>{{ $tr->user->name }}</td> <!-- Nama diambil dari relasi user -->
                    <td>{{ $tr->no_wa }}</td> <!-- No Telfon -->
                    <td>{{ $tr->pengalaman }}</td> <!-- Pengalaman dari model TambahanTrainer -->
                    <td>{{ $tr->status_akun }}</td> <!-- Status dari model TambahanTrainer -->
                </tr>
            @endforeach
        

        <tbody>
            
        </tbody>
    </table>
</div>

@endsection
