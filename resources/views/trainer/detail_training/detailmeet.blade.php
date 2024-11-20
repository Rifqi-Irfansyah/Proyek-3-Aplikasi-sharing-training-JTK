@extends('trainer.detail_training.sidebar')

<!-- @section('title', 'Halaman Utama') -->
@section($meet->id_jadwal, 'hovered')
@section('isi')
<!-- Main content -->
<div class="content bg-custom-pattern ms-300 vh-auto w-100">
    <div class="p-5">
        <div class="row">
            <div class="col-4 offset-4 text-center">
                <h1>Detail Meet</h1>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <button class="btn btn-md fs-6 rounded-5 btn-custom me-2 px-4 py-2" onClick="buttonEditMeet()">
                    <i class="fa fa-pencil me-1"></i> Edit Meet
                </button>
                <button class="btn btn-md fs-6 rounded-5 btn-danger px-4 py-2" onClick="buttonDeleteMeet()">
                    <i class="fa fa-trash me-1"></i> Delete
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

        <div class="row mt-4 align-items-center justify-content-center">
            <div class="col-3"><i class="fa-regular fa-calendar me-3"></i>Attendance</div>
            <div class="col-7">
                <div class="btn btn-sm btn-custom rounded-4 px-3" onClick="buttonAttendance()">Click Here</div>
            </div>
        </div>

    </div>
</div>


<script>
function buttonEditMeet() {
    @if ((\Carbon\Carbon::parse($meet->waktu_mulai)) <= (\Carbon\Carbon::now()->addDays(3)->setTimezone('Asia/Jakarta')))
        Swal.fire({
            icon: 'info',
            title: 'Meeting Cannot Edit!',
            text: 'Only meeting scheduled before H-3 are editable',
            backdrop: 'rgba(0,0,0,0.8)',
            customClass: {
                popup: 'popup-edit',
                confirmButton: 'btn-confirm',
                title: 'title',
                color: '#DE2323',
            }
        })
    @else
        var title = "Edit Meet h-3" + "\n\n";
        <?php
            $lastJadwal = $training->jadwalTrainings->slice(-2, 1)->first();
            $now = Carbon\Carbon::now('Asia/Jakarta')->addDays(3)->format('Y-m-d');
            if($lastJadwal->waktu_mulai < $now)
                $minDate = $now;
            else
                $minDate = $lastJadwal && $lastJadwal->waktu_mulai ? Carbon\Carbon::parse($lastJadwal->waktu_mulai)->addDays(1)->format('Y-m-d') : '';
        ?>
        (async () => {
            const {
                value: formValues
            } = await Swal.fire({
                title: title,
                backdrop: 'rgba(0,0,0,0.8)',
                confirmButtonText: 'Submit',
                html: `
                    <div class = "row">
                        <div class="col-6 ">
                            <div class="row align-items-center">
                                <div class="col-5 d-flex align-self-left">Date</div>
                                <div class="col-7 d-flex align-items-center">
                                    <input id="input-date" name="startMeet" type="date" value="{{ \Carbon\Carbon::parse($meet->waktu_mulai)->format('Y-m-d') }}"
                                        class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4" min="<?php echo $minDate; ?>">
                                </div>
                            </div>

                            <div class="row align-items-center mt-2">
                                <div class ="col-5 d-flex align-self-left">Start Meet</div>
                                <div class ="col-7 d-flex align-items-center">
                                    <input id="input-start" name="startMeet" type="time" value="{{ \Carbon\Carbon::parse($meet->waktu_mulai)->format('H:i') }}"
                                        class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                                </div>
                            </div>

                            <div class="row align-items-center mt-2">
                                <div class ="col-5 d-flex align-self-left">End Meet</div>
                                <div class ="col-7 d-flex align-items-center">
                                    <input id="input-end" name="endMeet" type="time" value="{{ \Carbon\Carbon::parse($meet->waktu_selesai)->format('H:i') }}"
                                        class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row align-items-center">
                                <div class ="col-5 d-flex align-self-left">Room/Link</div>
                                <div class ="col d-flex align-items-center">
                                    <input id="input-location" name="locationMeet" type="text" value="{{$meet->tempat_pelaksana}}" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                                </div>
                            </div>
                            <div class="row align-items-center mt-2">
                                <div class ="col-3">Status</div>
                                <div class ="col ms-3">
                                    <div class="d-flex align-items-center justify-content-around">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input text-sm-left" name="status" value="online" {{ ($meet->status == 'online') ? 'checked' : '' }}>Online
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input text-sm-left" name="status" value="offline" {{ ($meet->status == 'offline') ? 'checked' : '' }}>Offline
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class ="d-flex justify-content-left mt-4 mb-2"><div>Meeting Discussion</div></div>
                    <div class ="d-flex align-items-center">
                        <textarea class="form-control form-control-lg bg-light fs-6 rounded-4 ps-4" id="input-desc" rows="4">{{$meet->topik_pertemuan}}</textarea>
                    </div>
                `,
                focusConfirm: false,

                preConfirm: () => {
                    const date = document.getElementById("input-date").value;
                    const start = document.getElementById("input-start").value;
                    const end = document.getElementById("input-end").value;
                    const startMeet = `${date}T${start}`;
                    const endMeet = `${date}T${end}`;
                    const locationMeet = document.getElementById("input-location").value;
                    const status = document.querySelector('input[name="status"]:checked') ? document
                        .querySelector('input[name="status"]:checked').value : null;
                    const descMeet = document.getElementById("input-desc").value;

                    // Validasi input
                    if (!startMeet || !endMeet || !locationMeet || !status || !descMeet) {
                        Swal.showValidationMessage('Please complete all fields!');
                        setTimeout(() => {
                            Swal.close();
                        }, 3000);
                        return false;
                    }

                    const startDateTime = new Date(startMeet);
                    const endDateTime = new Date(endMeet);
                    const differenceInHours = (endDateTime - startDateTime) / (1000 * 60 * 60);

                    if (differenceInHours < 1) {
                        Swal.showValidationMessage('End time must be at least 1 hour after the start time!');
                        setTimeout(() => {
                            Swal.getValidationMessage().textContent = '';
                            Swal.resetValidationMessage()
                        }, 3000);
                        return false;
                    }

                    return {
                        startMeet,
                        endMeet,
                        locationMeet,
                        status,
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
                    // Kirim data ke server dengan AJAX
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('editMeet', $meet->id_jadwal)}}",
                        method: 'PATCH',
                        data: {
                            startMeet: formValues.startMeet,
                            endMeet: formValues.endMeet,
                            locationMeet: formValues.locationMeet,
                            status: formValues.status,
                            descMeet: formValues.descMeet
                        },
                        success: function(response) {
                            location.reload();

                            Swal.fire({
                                icon: 'success',
                                title: 'Success Saved!',
                                text: 'Meet have been added',
                                showConfirmButton: false,
                                backdrop: 'rgba(0,0,0,0.8)',
                                timer: 2000,
                                customClass: {
                                    popup: 'popup-success',
                                    title: 'title',
                                    color: '#DE2323',
                                }
                            })
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.responseJSON.message ||
                                'There was problem while saved data';
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed Saved!',
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
    @endif
}

function buttonDeleteMeet(){
    @if ((\Carbon\Carbon::parse($meet->waktu_mulai)) <= (\Carbon\Carbon::now()->addDays(3)->setTimezone('Asia/Jakarta')))
        Swal.fire({
            icon: 'info',
            title: 'Meeting Cannot Delete!',
            text: 'Only meeting scheduled before H-3 are deleteable',
            backdrop: 'rgba(0,0,0,0.8)',
            customClass: {
                popup: 'popup-edit',
                confirmButton: 'btn-confirm',
                title: 'title',
                color: '#DE2323',
            }
        })
    @elseif($training->jadwalTrainings()->count() <= 4)
        Swal.fire({
            icon: 'info',
            title: 'Meeting Cannot Delete!',
            text: 'The total number of meetings must be 4 or more',
            backdrop: 'rgba(0,0,0,0.8)',
            customClass: {
                popup: 'popup-edit',
                confirmButton: 'btn-confirm',
                title: 'title',
                color: '#DE2323',
            }
        })
    @else
        (async () => {
            const confirmation = await Swal.fire({
                icon: "warning",
                title: "Are You Sure Want Delete",
                text: "This Meet",
                focusConfirm: false,
                backdrop: 'rgba(0,0,0,0.9)',
                showConfirmButton: true,
                showCancelButton: true,
                customClass: {
                    popup: 'popup-warning',
                    confirmButton: 'btn-cancel',
                    cancelButton: 'btn-confirm',
                    title: 'title',
                    color: '#DE2323',
                }
            });

            if (confirmation.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    }
                });
                $.ajax({
                    url: "{{route('deleteMeet', '')}}/" + "{{$meet->id_jadwal}}",
                    method: 'DELETE',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success Deleted!',
                            text: 'Modul has been deleted',
                            showConfirmButton: false,
                            backdrop: 'rgba(0,0,0,0.8)',
                            timer: 2000,
                            customClass: {
                                popup: 'popup-success',
                                title: 'title',
                                color: '#DE2323',
                            }
                        }).then(() => {
                            window.location.href = "{{ route('detailTraining', $training->id_training) }}";
                        });
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.error || xhr
                            .responseJSON.message ||
                            'There was problem while deleted data';
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed Deleted!',
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
            }
        })();
    @endif
}
function buttonAttendance(){
    var meetStart = new Date("{{ \Carbon\Carbon::parse($meet->waktu_mulai) }}");
    var meetEnd = new Date("{{ \Carbon\Carbon::parse($meet->waktu_selesai) }}");
    var now = new Date("{{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta') }}");
    @php
    @endphp
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
    else if(now >= meetStart && now <= meetEnd && ("{{auth()->user()->email ?? 'null'}}") == ("{{$training->email_trainer ?? 'null'}}" ) && (("{{$trainerAbsent?->status ?? 'null'}}") == 'null' || ("{{$trainerAbsent?->status ?? 'null'}}") == 'Tidak Hadir')){
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
                    url: "{{route('absen', $meet->id_jadwal)}}",
                    method: 'POST',
                    data: {
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
            html: ` <div class="mt-2 mb-3 fs-6">
                        <div class="row">
                            <div class="col-lg-3 col-6 d-flex align-items-left">
                                Trainer Start Meet
                            </div>
                            <div class="d-flex col-lg-9 col-6 align-items-left">
                                {{$meet->pertemuan_mulai}}
                            </div>
                        </div>
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-3 col-md-6 d-flex align-items-left">
                                Trainer End Meet
                            </div>
                            <div class="d-flex col-lg-9 col-6 align-items-left">
                            @if($meet->pertemuan_selesai)
                                {{$meet->pertemuan_selesai}}
                            @elseif((auth()->user()->email ?? 'null') === ($trainerAbsent->email ?? 'null'))
                                <form action="{{ route('editMeet', ['id' => $meet->id_jadwal]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="pertemuan_selesai" value="1">
                                    <button type="submit" class="btn btn-sm btn-custom mt-3 px-3 rounded-5">End Meet</button>
                                </form>
                            @endif
                            </div>
                            
                        </div>
                    </div>
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
                `
                ,
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
    @if(session('runButtonAttendance'))
        localStorage.setItem('runButtonAttendance', 'true');
        location.reload();
    @endif
});

</script>

@endsection