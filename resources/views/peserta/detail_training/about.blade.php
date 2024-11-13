@extends('peserta.detail_training.sidebar')

@section('aboutSelect', 'hovered')
@section('isi')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false,
                customClass: {
                    popup: 'popup-success',
                    title: 'title',
                }
            });
        @elseif(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                timer: 2000,
                showConfirmButton: false,
                customClass: {
                    popup: 'popup-error',
                    title: 'title',
                }
            });
        @endif
    });
</script>


<div class="content ms-300 vh-auto w-100" style="background-color: #9BBBF2;">

    <div class="row mt-5">
        <div class="col-8 offset-2 text-center">
        <h1 style="font-weight: 700">{{$training->judul_training}}</h1>
        </div>
    </div>

    <div class="container bg-white p-5 rounded-5 shadow ps-1 pt-1 mt-4 ms-5" style="margin-left: 40px;">
        <div class="row mt-5 justify-content-center">
            <div class="col-3"><i class="fa-solid fa-user-tie me-3"></i>Trainer</div>
            <div class="col-7">
                @if($training->user)
                    {{ $training->user->name }}
                @else
                    <span class="text-muted">No Trainer Yet</span>
                @endif
            </div>
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
