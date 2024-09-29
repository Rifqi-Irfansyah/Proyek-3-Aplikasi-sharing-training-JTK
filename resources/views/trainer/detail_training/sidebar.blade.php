@extends('../layoutmaster')

@section('title', 'Halaman Utama')

@section('content')


<div class="container-fluid p-0 d-flex bg-background_putih min-vh-100">
    <!-- Sidebar navigation -->
    <div class="navigation ps-4 bg-custom position-fixed h-100 overflow-auto">
        <div class=" my-2">
            <span class="title text-white ps-0">Trainify </span>
        </div>
        <button class="btn btn-back btn-md fs-6 rounded-5 py-2 w-50px h-50px">
            <i class="fa-solid fa-angle-left" aria-hidden="true"></i>
        </button>

        <ul class="list-unstyled mt-4 ps-1">
            <li class="d-flex align-items-center ps-4 py-1 mb-3 @yield('aboutSelect')">
                <a href="/detailTraining/{{$training->id_training}}" class=" text-decoration-none">
                    <span class="fs-6 fw-bold my-1 ">About Training</span>
                </a>
            </li>

            <li class="d-flex align-items-center ps-4 py-1 mb-3 @yield('modulSelect')">
                <a href="/modul/{{$training->id_training}}" class=" text-decoration-none">
                    <span class="fs-6 fw-bold my-1 ">Modul</span>
                </a>
            </li>

            <?php $i = 1; ?>
            @foreach($training->jadwalTrainings as $jadwal)
            <li class="d-flex align-items-center ps-4 py-1 mb-3 @yield($jadwal->id_jadwal)">
                <a href="/detailMeet/MT{{$jadwal->id_jadwal}}" class=" text-decoration-none">
                    <span class="fs-6 fw-bold my-1">{{$i}}st Meet</span>
                </a>
            </li>
            <?php $i++; ?>
            @endforeach

            <li class="d-flex align-items-center ps-4 py-1 mb-3" onClick="buttonEdit()">
                <a href="#" class=" text-decoration-none">
                    <span class="fs-6 fw-bold my-1">Add Meet {{$i}}st</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main content -->
    @yield('isi')
</div>

<script>
function buttonEdit() {
    var title = "Add " + "<?php echo $i; ?>" + "st Meet\n" + "<?php echo $training->judul_training; ?>" + "\n\n";
    (async () => {
        const {
            value: formValues
        } = await Swal.fire({
            title: title,
            html: `
            <form action="{{route('tambahmeet')}}" method="post" id="meetForm" class="container-fluid">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row align-items-center">
                    <div class ="col-4">Date</div>
                    <div class ="col-7 d-flex align-items-center">
                        <input id="input-date" name="startMeet" type="date" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                    </div>
                </div>

                <div class="row align-items-center mt-2">
                    <div class ="col-4">Start</div>
                    <div class ="col-7 d-flex align-items-center">
                        <input id="input-start" name="startMeet" type="time" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                    </div>
                </div>

                <div class="row align-items-center mt-2">
                    <div class ="col-4">End</div>
                    <div class ="col-7 d-flex align-items-center">
                        <input id="input-end" name="endMeet" type="time" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                    </div>
                </div>

                <div class="row align-items-center mt-2">
                    <div class ="col-4">Location</div>
                    <div class ="col-7 d-flex align-items-center">
                        <input id="input-location" name="locationMeet" type="text" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                    </div>
                </div>

                <div class="row align-items-center mt-2">
                    <div class ="col-4">Status</div>
                    <div class ="col-6 ms-3">
                        <div class="d-flex align-items-center justify-content-around mt-3">
                            <div class="form-check">    
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" value="online">Online
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" value="offline">Offline
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            `,
            focusConfirm: false,

            preConfirm: () => {
                const date = document.getElementById("input-date").value;
                const start = document.getElementById("input-start").value;
                const end  = document.getElementById("input-end").value;
                const startMeet = `${date}T${start}`;
                const endMeet = `${date}T${end}`; 
                const locationMeet = document.getElementById("input-location").value;
                const status = document.querySelector('input[name="status"]:checked') ? document
                    .querySelector('input[name="status"]:checked').value : null;

                // Validasi input
                if (!startMeet || !endMeet || !locationMeet || !status) {
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
                    status
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
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: true,
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
                        status: formValues.status
                    },
                    success: function(response) {
                        location.reload(); 

                        Swal.fire({
                            icon: 'success',
                            title: 'Success Saved!',
                            text: 'Meet have been added',
                            showConfirmButton: false,
                            timer: 1000,
                            customClass: {
                                popup: 'popup-success',
                                title: 'title',
                                color: '#DE2323',
                            }
                        })
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.message || 'There was problem while saved data';
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed Saved!',
                            text: errorMessage,
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