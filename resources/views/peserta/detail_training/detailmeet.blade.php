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
                <div class="btn btn-sm btn-custom rounded-4 px-3" onClick="buttonAttendance()">Click Here</div>
            </div>
        </div>

    </div>
</div>

<script>
function buttonAttendance(){
    var meetStart = new Date("{{ \Carbon\Carbon::parse($meet->waktu_mulai) }}");
    var meetEnd = new Date("{{ \Carbon\Carbon::parse($meet->waktu_selesai) }}");
    var now = new Date("{{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta') }}");
    if(now < meetStart){
        Swal.fire({
            icon: 'warning',
            title: 'Cannot Absence!',
            text: 'Outside of attendance time',
            backdrop: 'rgba(0,0,0,0.8)',
            customClass: {
                popup: 'popup-warning',
                confirmButton: 'btn-confirm',
                title: 'title',
                color: '#DE2323',
            }
        })
    }
    else if(now >= meetStart && now <= meetEnd && ("{{auth()->user()->email ?? 'null'}}") == ("{{$trainerAbsent->email ?? 'null'}}" ) && ("{{$trainerAbsent->status ?? 'null'}}") == "Tidak Hadir"){
        (async () => {
            const confirmation = await Swal.fire({
                icon: 'info',
                title: 'Attendance',
                showCloseButton: true,
                showConfirmButton: true,
                confirmButtonText: "Present",
                backdrop: 'rgba(0,0,0,0.8)',
                customClass: {
                    popup: 'popup-edit',
                    confirmButton: 'btn-confirm',
                    title: 'title',
                    color: '#DE2323',
                }
            });

            if (confirmation.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('absen')}}",
                    method: 'POST',
                    data: {
                        id_jadwal: {{$meet->id_jadwal}},
                        email: "{{ auth()->user()->email }}"
                    },
                    success: function(response) {
                        (async()=>{
                            await Swal.fire({
                                icon: 'success',
                                title: 'Success Absence!',
                                showConfirmButton: false,
                                backdrop: 'rgba(0,0,0,0.8)',
                                timer: 1000,
                                customClass: {
                                    popup: 'popup-success',
                                    title: 'title',
                                    color: '#DE2323',
                                }
                        })
                        localStorage.setItem('runButtonAttendance', 'true');
                        location.reload();
                    })();

                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON.message ||
                    'There was problem while saved data';
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed Absence!',
                        text: errorMessage,
                        backdrop: 'rgba(0,0,0,0.8)',
                        customClass: {
                            popup: 'popup-error',
                            confirmButton: 'btn-confirm',
                            title: 'title',
                            color: '#DE2323',
                        }
                    })
                }
            });
        }})();
    }
    else{
        Swal.fire({
            title: 'Attendance Recap',
            showCloseButton: true,
            showConfirmButton: false,
            backdrop: 'rgba(0,0,0,0.8)',
            html: `
                    <table class="table table-striped" style="border-radius: 1rem; overflow: hidden; background-color: transparent;">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col-6">Name</th>
                                <th scope="col-3">Time</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($meet->absen as $absen)
                                <tr class="text-center">
                                    <th scope="row">{{$i}}</th>
                                    <td>{{$absen->user->name}}</td>
                                    <td>{{$absen->updated_at}}</td>
                                    <td class="{{ $absen->status === 'Hadir' ? 'text-success' : ($absen->status === 'Tidak Hadir' ? 'text-danger' : 'text-warning') }}">
                                        {{ $absen->status }}
                                    </td>
                                </tr>
                                @php $i++ @endphp
                            @endforeach
                        </tbody>
                    </table>
                `,
            customClass: {
                popup: 'popup-modul',
                title: 'title',
                color: '#DE2323',
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('runButtonAttendance')) {
        buttonAttendance();
        localStorage.removeItem('runButtonAttendance');
    }
});

</script>
@endsection
