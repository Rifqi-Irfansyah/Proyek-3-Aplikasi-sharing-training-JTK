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
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class ="col-4">Start Meet</div>
                    <div class ="col-8 d-flex align-items-center">
                        <input id="swal-input1" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                    </div>
                </div>

                <div class="row align-items-center mt-2">
                    <div class ="col-4">End Meet</div>
                    <div class ="col-8 d-flex align-items-center">
                        <input id="swal-input2" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                    </div>
                </div>

                <div class="row align-items-center mt-2">
                    <div class ="col-4">Modul</div>
                    <div class ="col-8 d-flex align-items-center">
                        <input id="swal-input3" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                    </div>
                </div>
            </div>
        `,
            focusConfirm: false,

            preConfirm: () => {
                return [
                    document.getElementById("swal-input1").value,
                    document.getElementById("swal-input2").value
                ];
            },
            customClass: {
                popup: 'popup-edit',
                confirmButton: 'btn-confirm',
                title: 'title',
                color: '#DE2323',
            }
        });
        if (formValues) {
            Swal.fire(JSON.stringify(formValues));
        }
    })()
}
</script>