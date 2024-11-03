@extends('peserta.detail_training.sidebar')

@section('aboutSelect', 'hovered')
@section('isi')

<div class="content ms-300 vh-auto w-100" style="background-color: #9BBBF2;">

    <div class="row mt-5">
        <div class="col-8 offset-2 text-center">
            <h1 style="font-weight: 700">Detail Meet - {{$training->judul_training}}</h1>
        </div>
    </div>

    <div class="container bg-white p-5 rounded-5 shadow ps-1 pt-1 mt-5 ms-5" style="margin-left: 40px;">

        <div class="row mt-5 justify-content-center">
            <div class="col-3"><i class="fa-regular fa-clock me-3"></i>Start Meet</div>
            <div class="col-7">{{$meet->waktu_mulai}}</div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-3"><i class="fa-regular fa-clock me-3"></i>Finish Meet</div>
            <div class="col-7">{{$meet->waktu_selesai}}</div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-3"><i class="fa-solid fa-bars-progress me-3"></i>Status</div>
            <div class="col-7">{{$meet->status}}</div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-3"><i class="fa-solid fa-link me-3"></i>Room/Link</div>
            <div class="col-7">{{$meet->tempat_pelaksana}}</div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-3"><i class="fa-solid fa-chalkboard me-3"></i>Topic</div>
            <div class="col-7">{{$meet->topik_pertemuan}}</div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-3"><i class="fa-solid fa-user-check me-3"></i>Attendance</div>
            <div class="col-7">
                <div class="btn btn-sm btn-custom rounded-4 px-3">Click Here</div>
            </div>
        </div>

    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('runButtonAttendance')) {
        buttonAttendance();
        localStorage.removeItem('runButtonAttendance');
    }
});

</script>
@endsection
