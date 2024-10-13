@extends('trainer.detail_training.sidebar')

<!-- @section('title', 'Halaman Utama') -->
@section($meet->id_jadwal, 'hovered')
@section('isi')
<!-- Main content -->
<div class="content bg-custom-pattern ms-300 vh-auto w-100">
    <div class="p-5">
        <div class="row">
            <div class="col-8 offset-2 text-center">
                <h1>Detail Meet</h1>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center">
                <button class="btn btn-md fs-6 rounded-5 btn-custom w-100 py-2" onClick="buttonEditMeet()">
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
    @if (\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($meet->waktu_mulai), true) < 3)
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
                                        class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
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
                        url: '/tambahMeet',
                        method: 'POST',
                        data: {
                            id_training: {{$training -> id_training}},
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

function buttonAttendance(){
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
        }
    })();
}


function buttonAttendancee(){
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
            // AJAX request setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Proceed with your AJAX call or other logic here
            $.ajax({
                url: "{{route('absen')}}",
                method: 'POST',
                data: {
                    // your data
                },
                success: function(response) {
                    console.log('Success', response);
                },
                error: function(xhr, status, error) {
                    console.log('Error', error);
                }
            });
        }
    })();
}
</script>

@endsection