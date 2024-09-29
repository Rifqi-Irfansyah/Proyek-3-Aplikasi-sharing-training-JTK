@extends('../layoutmaster')

@section('title', 'Halaman Utama')

@section('content')


<div class="container-fluid p-0 d-flex bg-background_putih min-vh-100">
    <!-- Sidebar navigation -->
    <div class="navigation ps-4 bg-custom position-fixed h-100">
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
                    <div class ="col-4">Start Meet</div>
                    <div class ="col-7 d-flex align-items-center">
                        <input id="swal-input1" name="startMeet" type="datetime-local" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                    </div>
                </div>

                <div class="row align-items-center mt-2">
                    <div class ="col-4">End Meet</div>
                    <div class ="col-7 d-flex align-items-center">
                        <input id="swal-input2" name="endMeet" type="datetime-local" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                    </div>
                </div>

                <div class="row align-items-center mt-2">
                    <div class ="col-4">Location Meet</div>
                    <div class ="col-7 d-flex align-items-center">
                        <input id="swal-input3" name="locationMeet" type="text" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
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
                const startMeet = document.getElementById("swal-input1").value;
                const endMeet = document.getElementById("swal-input2").value;
                const locationMeet = document.getElementById("swal-input3").value;
                const status = document.querySelector('input[name="status"]:checked') ? document.querySelector('input[name="status"]:checked').value : null;

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
                reverseButtons: true
            });

            if (confirmation.isConfirmed) {
                // Kirim data ke server dengan AJAX
                $.ajax({
                    url: '/tambahMeet',
                    method: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        startMeet: formValues.startMeet,
                        endMeet: formValues.endMeet,
                        locationMeet: formValues.locationMeet,
                        status: formValues.status
                    },
                    success: function(response) {
                        Swal.fire('Saved!', 'Your changes have been saved.', 'success');
                    },
                    error: function(error) {
                        Swal.fire('Error!', 'There was a problem saving the data.', 'error');
                    }
                });
            } else {
                Swal.fire('Cancelled', 'No changes were made.', 'error');
            }
        }
    })();
}

</script>