@extends('../layoutmaster')

@section('title', 'Halaman Utama')

@section('content')


<div class="container-fluid p-0 d-flex bg-background_putih min-vh-100">
    <!-- Sidebar navigation -->
    <div class="navigation ps-4 bg-custom position-fixed h-100">
        <div class=" my-2">
            <span class="title text-white ps-0">Trainify</span>
        </div>
        <button class="btn btn-back btn-md fs-6 rounded-5 py-2 w-50px h-50px">
            <i class="fa-solid fa-angle-left" aria-hidden="true"></i>
        </button>

        <ul class="list-unstyled mt-4 ps-1">
            <li class="d-flex align-items-center ps-4 py-1 mb-3" id="aboutTraining">
                <a href="#" class=" text-decoration-none">
                    <span class="fs-6 fw-bold my-1">About Training</span>
                </a>
            </li>

            <?php $i = 1; ?>
            @foreach($training->jadwalTrainings as $jadwal)
            <li class="d-flex align-items-center ps-4 py-1 mb-3">
                <a href="#" class=" text-decoration-none">
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
    <div class="content bg-background_putih ms-300 vh-auto w-100">
        <div class="p-2 d-md-none d-flex text-white bg-success">
            <a href="#" class="text-white" data-bs-toggle="offcanvas" data-bs-target="#bdSidebar">
                <i class="fa-solid fa-bars"></i>
            </a>
            <span class="ms-3">GFG Portal</span>
        </div>
        <div class="p-5">
            <div class="row">
                <div class="col-8 offset-2 text-center">
                    <h1>{{$training->judul_training}}</h1>
                </div>
                <div class="col-2 d-flex justify-content-end align-items-center">
                    <button class="btn btn-md fs-6 rounded-5 btn-custom w-100 py-2" onClick="buttonEdit()">
                        <i class="fa-regular fa-user"></i> Edit Training
                    </button>
                </div>
            </div>

            <!-- Trainer information -->
            <div class="row mt-5">
                <div class="col-3"><i class="fa-solid fa-user-tie me-3"></i>Trainer</div>
                <div class="col">{{$training->user->name}}</div>
            </div>

            <div class="row mt-4">
                <div class="col-3"><i class="fa-solid fa-bars-progress me-3"></i>Status</div>
                <div class="col">{{$training->status}}</div>
            </div>

            <div class="row mt-4">
                <div class="col-3"><i class="fa-solid fa-user-group me-3"></i>Kuota</div>
                <div class="col">{{$training->kuota}}</div>
            </div>

            <div class="row mt-4">
                <div class="col-3"><i class="fa-regular fa-calendar me-3"></i>Date Training</div>
                <div class="col">
                    @foreach($training->jadwalTrainings as $jadwal)
                    <div>{{$jadwal->waktu_mulai}}</div>
                    @endforeach

                </div>
            </div>

            <div class="row mt-4">
                <div class="col-3"><i class="fa-solid fa-align-center me-3"></i>Description</div>
                <div class="col">{{$training->deskripsi}}</div>
            </div>
        </div>
    </div>
</div>

<script>
// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
    list.forEach((item) => {
        item.classList.remove("hovered");
    });
    this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("click", activeLink));
document.getElementById("aboutTraining").classList.add("hovered");

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function() {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};
</script>

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