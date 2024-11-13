@extends('../layoutmaster')

@section('title', 'Preview Training')

@section('content')
@include('peserta.topbarPeserta')
<section class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center">
        <button class="btn btn-back btn-md fs-5 rounded-5 py-2 w-50px h-50px">
            <a href="{{ route('beranda_peserta') }}"><i class="fa-solid fa-angle-left" aria-hidden="true"></i></a>
        </button>
        <h1 class="text-center flex-grow-1"><strong>{{ $training->judul_training }}</strong></h1>
    </div>

    <div class="card mt-3 pt-4 pb-2" style="border-radius: 70px">
        <div class="row">
            <div class="text-center">
                <h4><strong>Training Description</strong></h4>
                <p class="me-5 ms-5 mb-3">{{ $training->deskripsi }}</p>
            </div>
        </div>

        <div class="text-center mt-3">
            <i class="fas fa-user"></i><strong> Trainer</strong><p class="mb-4">{{ $training->email_trainer }}</p>
            <i class="fa-regular fa-calendar"></i><strong> Timeline Training</strong><br>
            <p>
                {{ $total_pertemuan->jadwal_trainings_count }} Pertemuan<br>
                {{ \Carbon\Carbon::parse($training->jadwalTrainings->first()->waktu_mulai)->format('d M Y') }} sd.
                {{ \Carbon\Carbon::parse($training->jadwalTrainings->last()->waktu_selesai)->format('d M Y') }}
            </p>
            <form id="joinForm" action="{{ route('joinTrainingPeserta', $training->id_training) }}" method="POST">
                @csrf
                <button type="button" id="joinNowButton" class="btn btn-dark rounded-pill px-4 py-2 mt-4" style="cursor: pointer;">
                    <strong>JOIN NOW!</strong>
                </button>
            </form>
        </div>
    </div>
</section>
@include('footer')
<script>
    document.getElementById('joinNowButton').addEventListener('click', function (e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to join this training?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true,
            backdrop: 'rgba(0,0,0,0.8)',
            customClass: {
                popup: 'popup-edit',
                confirmButton: 'btn-confirm',
                cancelButton: 'btn-cancel',
                title: 'title'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form jika pengguna memilih "Yes"
                document.getElementById('joinForm').submit();
            }
        });
    });
</script>
@endsection
