@extends('trainer.detail_training.sidebar')

<!-- @section('title', 'Halaman Utama') -->
@section('aboutSelect', 'hovered')
@section('isi')

<!-- Main content -->
<div class="content bg-background_putih ms-300 vh-auto w-100">

    <div class="p-5">
        <div class="row">
            <div class="col-8 offset-2 text-center">
                <h1>{{$training->judul_training}}</h1>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center">
                <button class="btn btn-md fs-6 rounded-5 btn-custom w-100 py-2" onClick="buttonEdit()">
                    <i class="fa-regular fa-user"></i> Edit Training
                </button>
            </div>
        </div>

        <!-- Trainer information -->
        <div class="row mt-5 justify-content-center">
            <div class="col-3"><i class="fa-solid fa-user-tie me-3"></i>Trainer</div>
            <div class="col-7">{{$training->user->name}}</div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-3"><i class="fa-solid fa-bars-progress me-3"></i>Status</div>
            <div class="col-7">{{$training->status}}</div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-3"><i class="fa-solid fa-user-group me-3"></i>Kuota</div>
            <div class="col-7">{{$total_peserta->peserta_count}} of {{$training->kuota}} Participants joined</div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-3"><i class="fa-regular fa-calendar me-3"></i>Date Training</div>
            <div class="col-7">
                @if($training->jadwalTrainings->isEmpty())
                <div class="text-primary">Haven't Create Meet</div>
                @else
                @foreach($training->jadwalTrainings as $jadwal)
                @php
                $jadwalMulai = \Carbon\Carbon::parse($jadwal->waktu_mulai);
                $isPast = $jadwalMulai->isBefore(\Carbon\Carbon::now());
                $isToday = $jadwalMulai->isToday();
                @endphp
                <div style="color: {{ $isToday ? 'green' : ($isPast ? 'gray' : 'black') }};">
                    {{ sprintf('%02d', $jadwalMulai->day) }}
                    {{ $jadwalMulai->translatedFormat('F Y, H:i') }}
                </div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-3"><i class="fa-solid fa-align-center me-3"></i>Description</div>
            <div class="col-7">{{$training->deskripsi}}</div>
        </div>
    </div>
</div>
@endsection