@extends('../layoutmaster')

@section('title', 'Approve Trainer')

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
        width: 60%;
        margin: 0 auto;
        margin: 30px 0 50px;
        padding-bottom: 20px;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .table th, .table td {
        padding: 8px 10px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        font-size: 16px;
    }
    .table th {
        background-color: #91c3f2;
        font-weight: bold;
    }
    .table td {
        background-color: white;
        transition: background-color 0.3s;
    }
    .table tr:hover td {
        background-color: #f1f7fc;
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
</style>

<div class="d-flex flex-column min-vh-100"> 

    <div class="container mt-5">
        <h1>Approve Trainer</h1>
    </div>

    <div class="container table-container">
        <table class="table">
            <thead class="table-primary">
                <tr>
                    <th>Trainer Email</th>
                    <th>Trainer Name</th>
                    <th>Training Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trainers as $tr)
                    @if ($tr->status_pengajuan === 'Dikirim')
                        <tr>
                            <td>{{ $tr->email_trainer }}</td>
                            <td>{{ $tr->user->name }}</td>
                            <td>{{ $tr->training->judul_training }}</td>
                            <td>{{ \Carbon\Carbon::parse($tr->training->jadwalTrainings->first()->waktu_mulai)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($tr->training->jadwalTrainings->last()->waktu_selesai)->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('view-trainer-detail-approve', ['email' => $tr->email_trainer, 'id_training' => $tr->id_training]) }}" class="btn btn-view">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <footer class="mt-auto">
        @include('footer')
    </footer> 

</div>

@endsection
