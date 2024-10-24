@extends('peserta.detail_training.sidebar')

@section('aboutSelect', 'hovered')
@section('isi')

<div class="content ms-300 vh-auto w-100" style="background-color: #9BBBF2;">

    <div class="row mt-5">
        <div class="col-8 offset-2 text-center">
            <h1 style="font-weight: 700">Modul - {{$training->judul_training}}</h1>
        </div>
    </div>

    <div class="container bg-white p-5 rounded-5 shadow ps-1 pt-1 mt-5 ms-5" style="margin-left: 40px;">
        @if($modul->isEmpty())
        <div class="d-flex flex-column align-items-center justify-content-center h-100 mb-5">
            <h1>The Training Not Have Module</h1>
        </div>
        @else
        <div class="row mt-2 px-5">
            @foreach($modul as $file)
            <div class="col-lg-3 col-md-4 col-sm-6 mt-3">
                <div class="card border-0 shadow-sm rounded-4 text-center h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div class="icon-container mb-3">
                            <i class="fas fa-file-pdf ps-3 fa-3x me-3 text-danger"></i>
                        </div>
                        <h6 class="card-title font-weight-bold mb-2">{{ $file->judul }}</h6>
                        <a href="#" class="btn btn-confirm mt-auto" id="btn-{{$file->nama_file}}">Open File</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    @foreach($modul as $file)
    document.getElementById('btn-{{ $file->nama_file }}').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            showConfirmButton: false,
            html: `
                <embed type="application/pdf" src="{{ asset('storage/uploads/' . $file->nama_file) }}" class="full-size"></embed>
            `,
            focusConfirm: false,
            backdrop: 'rgba(0,0,0,0.9)',
            showCloseButton: true,
            customClass: {
                popup: 'popup-modul',
                confirmButton: 'btn-confirm',
                title: 'title',
                color: '#DE2323',
            }
        });
    });
    @endforeach
});
</script>

@endsection
