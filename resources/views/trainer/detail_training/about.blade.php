@extends('trainer.detail_training.sidebar')

<!-- @section('title', 'Halaman Utama') -->
@section('aboutSelect', 'hovered')
@section('isi')

<!-- Main content -->
<div class="content bg-custom-pattern ms-300 vh-auto w-100">

    <div class="p-5">
        <div class="row">
            <div class="col-8 offset-2 text-center">
                <h1>{{$training->judul_training}}</h1>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center">
                <button class="btn btn-md fs-6 rounded-5 btn-custom w-100 py-2" onClick="buttonEditTraining()">
                    <i class="fa-regular fa-user"></i> Edit Training
                </button>
            </div>
        </div>

        <!-- Trainer information -->
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


<script>
function buttonEditTraining() {
    var title = "Edit Training \n" + "<?php echo $training->judul_training; ?>" + "\n\n";
    (async () => {
        const {
            value: formValues
        } = await Swal.fire({
            title: title,
            backdrop: 'rgba(0,0,0,0.8)',
            confirmButtonText: 'Submit',
            html: `
                <div class="vw-50">
                <div class="row align-items-center">
                    <div class="col-5 d-flex align-self-left">Kuota</div>
                    <div class="col-7 d-flex align-items-center">
                        <input id="input-kuota" name="startMeet" type="number" value="{{$training->kuota}}" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                    </div>
                </div>
                <div class ="d-flex justify-content-left mt-4 mb-2"><div>Meeting Discussion</div></div>
                <div class ="d-flex align-items-center">
                    <textarea class="form-control form-control-lg bg-light fs-6 rounded-4 ps-4" id="input-desc" rows="4">{{$training->deskripsi}}</textarea>
                </div>
                </div>
            `,
            focusConfirm: false,

            preConfirm: () => {
                const kuota = document.getElementById("input-kuota").value;
                const descMeet = document.getElementById("input-desc").value;

                // Validasi input
                if (!kuota || !descMeet) {
                    Swal.showValidationMessage('Please complete all fields!');
                    setTimeout(() => {
                        Swal.close();
                    }, 3000);
                    return false;
                }

                return {
                    kuota,
                    descMeet
                };
            },
            customClass: {
                popup: 'popup-edit',
                confirmButton: 'btn-confirm',
                title: 'title',
                color: '#DE2323',
            }
        });

        if (formValues) {
            const confirmation = await Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to save these changes?",
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
                    title: 'title',
                    color: '#DE2323',
                }
            });

            if (confirmation.isConfirmed) {
                console.log(formValues.kuota);
                console.log(formValues.descMeet);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{route('editTraining')}}",
                    // method: 'POST',
                    data: {
                        id : {{$training->id_training}},
                        kuota: formValues.kuota,
                        descMeet: formValues.descMeet
                    },
                    success: function(response) {
                        location.reload(); 

                        Swal.fire({
                            icon: 'success',
                            title: 'Success Edit!',
                            text: 'Training have been edited',
                            showConfirmButton: false,
                            backdrop: 'rgba(0,0,0,0.8)',
                            timer: 1000,
                            customClass: {
                                popup: 'popup-success',
                                title: 'title',
                                color: '#DE2323',
                            }
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                        var errorMessage = xhr.responseJSON.message || 'There was problem while updated data';
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed Edit!',
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
            } else {
                Swal.fire('Cancelled', 'No changes were made.', 'error');
                Swal.fire({
                    icon: 'warning',
                    title: 'Cancelled',
                    text: 'No changes were made',            
                    showConfirmButton: false,
                    backdrop: 'rgba(0,0,0,0.8)',
                    timer: 1000,
                    customClass: {
                        popup: 'popup-edit',
                        title: 'title',
                    }
                })
            }
        }
    })();
}
</script>
@endsection