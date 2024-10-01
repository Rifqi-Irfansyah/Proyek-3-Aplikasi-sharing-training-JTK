@extends('trainer.detail_training.sidebar')

<!-- @section('title', 'Halaman Utama') -->
@section($meet->id_jadwal, 'hovered')
@section('isi')
<!-- Main content -->
<div class="content bg-background_putih ms-300 vh-auto w-100">
    <div class="p-5">
        <div class="row">
            <div class="col-8 offset-2 text-center">
                <h1>Detail Meet</h1>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center">
                <button class="btn btn-md fs-6 rounded-5 btn-custom w-100 py-2" onClick="buttonEdit()">
                    <i class="fa-regular fa-user"></i> Edit Meet
                </button>
            </div>
        </div>

        <div class="row mt-5 justify-content-center">
            <div class="col-3"><i class="fa-solid fa-clock me-3"></i>Start Meet</div>
            <div class="col-7">{{$meet->waktu_mulai}}</div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-3"><i class="fa-solid fa-clock me-3"></i>Finish Meet</div>
            <div class="col-7">{{$meet->waktu_selesai}}</div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-3"><i class="fa-solid fa-align-center me-3"></i>Status</div>
            <div class="col-7">{{$meet->status}}</div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-3"><i class="fa-solid fa-user-group me-3"></i>Room/Link</div>
            <div class="col-7">{{$meet->tempat_pelaksana}}</div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-3"><i class="fa-solid fa-user-group me-3"></i>Topic</div>
            <div class="col-7">{{$meet->topik_pertemuan}}</div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-3"><i class="fa-regular fa-calendar me-3"></i>Attendance</div>
            <div class="col-7">
                Click Here
            </div>
        </div>

    </div>
</div>
@endsection