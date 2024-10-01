@extends('trainer.detail_training.sidebar')

<!-- @section('title', 'Halaman Utama') -->
@section($meet->id_jadwal, 'hovered')
@section('isi')
<!-- Main content -->
<div class="content bg-background_putih ms-300 vh-auto w-100">
    <div class="p-5">
        <div class="text-center">
            <h1>Detail Meet</h1>
        </div>

        <!-- Trainer information -->
        <div class="row mt-5">
            <div class="col-3"><i class="fa-solid fa-clock me-3"></i>Start Meet</div>
            <div class="col">{{$meet->waktu_mulai}}</div>
        </div>

        <div class="row mt-4">
            <div class="col-3"><i class="fa-solid fa-clock me-3"></i>Finish Meet</div>
            <div class="col">{{$meet->waktu_selesai}}</div>
        </div>

        <div class="row mt-4">
            <div class="col-3"><i class="fa-solid fa-align-center me-3"></i>Status</div>
            <div class="col">{{$meet->status}}</div>
        </div>

        <div class="row mt-4">
            <div class="col-3"><i class="fa-solid fa-user-group me-3"></i>Media</div>
            <div class="col">{{$meet->tempat_pelaksana}}</div>
        </div>

        <div class="row mt-4">
            <div class="col-3"><i class="fa-solid fa-user-group me-3"></i>Topic</div>
            <div class="col">{{$meet->topik_pertemuan}}</div>
        </div>

        <div class="row mt-4">
            <div class="col-3"><i class="fa-regular fa-calendar me-3"></i>Attendance</div>
            <div class="col">
                Click Here
            </div>
        </div>

    </div>
</div>
@endsection