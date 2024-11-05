@extends('../layoutmaster')

@section('title', 'Preview Training')

@section('content')


<!-- FAILED LOGIN -->
<script>
@if(session('error'))
var errorMessage = "{{ Session::get('error') }}";
Swal.fire({
    icon: 'error',
    title: 'Login Failed',
    text: errorMessage,
    confirmButtonText: 'OK',
    backdrop: 'rgba(0,0,0,0.8)',
    customClass: {
        popup: 'popup-error',
        confirmButton: 'btn-dark rounded-pill',
        title: 'title',
        color: '#DE2323',
    }
})

@elseif(session('success'))
var successMessage = "{{ Session::get('success') }}";
Swal.fire({
    icon: 'success',
    title: 'Register Success!',
    text: successMessage,
    showConfirmButton: false,
    backdrop: 'rgba(0,0,0,0.8)',
    timer: 2000,
    customClass: {
        popup: 'popup-success',
        title: 'title',
        color: '#DE2323',
    }
})
@endif

// Script untuk menampilkan pop-up saat JOIN NOW! diklik
$(document).ready(function() {
    $('#joinNowButton').on('click', function() {
        Swal.fire({
            title: 'Join Training',
            text: 'Apakah Anda yakin ingin bergabung dengan pelatihan ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            backdrop: 'rgba(0,0,0,0.8)',
            customClass: {
                confirmButton: 'btn-dark rounded-pill',
                cancelButton: 'btn-light rounded-pill',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Bergabung Berhasil!',
                    text: 'Anda telah berhasil bergabung dengan pelatihan.',
                    confirmButtonText: 'OK',
                    backdrop: 'rgba(0,0,0,0.8)',
                    customClass: {
                        confirmButton: 'btn-dark rounded-pill',
                    }
                });
            }
        });
    });
});
</script>

<nav class="navbar navbar-expand-lg px-5 shadow bg-custom" style="margin-top: -5px;">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand fw-bold d-flex align-items-center" style="font-size: 1.2rem;">
            <img src="{{asset('asset/logo.png')}}" alt="Logo" style="margin-left: 5px; width: 30px;">
            <span>TRAINIFY</span>
        </a>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto" style="gap: 30px">
                <li class="nav-link nav-item">
                    <a class="nav-link {{ request()->routeIs('') ? 'text-white' : '' }}"
                        style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="{ }">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <a class="nav-link {{ request()->routeIs('') ? 'text-white' : '' }}"
                        style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="{ }">
                        <i class="fas fa-check"></i> Approve Trainer
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <a class="nav-link" style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="{ }">
                        <i class="fas fa-cog"></i> Verification Trainer
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <a class="nav-link {{ request()->routeIs('') ? 'text-white' : '' }}"
                        style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="{ }">
                        <i class="fas fa-list"></i> List Trainer
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <a class="nav-link {{ request()->routeIs('') ? 'text-white' : '' }}"
                        style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="{ }">
                        <i class="fas fa-book"></i> Module
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <div class="dropdown">
                        <a class="nav-link align-items-center" style="font-size: 0.9rem; display: flex; gap: 8px;"
                            href="{{ route('login') }}" id="dropdownMenuButton">
                            <i class="fas fa-user"></i> Profile
                        </a>
                        <ul class="dropdown-menu px-2 rounded-2" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item rounded-3" href="#">Profile</a></li>
                            <li><a class="dropdown-item rounded-3" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <button class="btn btn-back btn-md fs-5 rounded-5 py-2 w-50px h-50px">
        <i class="fa-solid fa-angle-left" aria-hidden="true"></i>
        </button>
        <h1 class="text-center flex-grow-1">DIGITAL MARKETING</h1>
    </div>

    <div class="card mt-4 p-4" style="border-radius: 70px">
        <div class="row">
            <div class="col-md-6 text-center">
                <h3>About Training</h3>
                <p>Digital marketing adalah proses pemasaran menggunakan teknologi digital seperti internet, perangkat seluler, dan media digital lainnya.
                    Training ini bertujuan untuk memberikan pemahaman tentang konsep dasar digital marketing, mengenalkan platform-platform utama,
                    serta cara mengimplementasikan strategi yang tepat guna meningkatkan penjualan dan brand awareness.
                    Selain itu, peserta akan belajar cara mengukur keberhasilan strategi digital yang dijalankan.</p>
            </div>
            <div class="col-md-6 text-center">
                <p>Pelatihan digital marketing mencakup lima modul utama. Modul pertama membahas konsep digital marketing, perbedaannya dengan pemasaran tradisional,
                    serta tren terbaru seperti media sosial, SEO, dan email marketing. Modul kedua fokus pada platform utama seperti website yang SEO-friendly, media sosial,
                    dan Google Ads. Modul ketiga membahas content marketing, termasuk pembuatan konten yang efektif dan pengelolaan content calendar. Modul keempat mengupas email marketing,
                    dengan fokus pada kampanye, automasi, dan segmentasi. Modul kelima membahas pengukuran kinerja digital marketing menggunakan Google Analytics dan Facebook Insights.</p>
            </div>
        </div>

        <div class="text-center mt-4">
            <i class="fas fa-user"></i><strong>Trainer</strong><p><br>Dio Rahman Putra</p>
            <p><strong>Timeline Training</strong> <br> 2 Bulan - 7 Pertemuan - Online/Offline</p>
            <!-- Menambahkan ID pada tombol -->
            <a id="joinNowButton" class="btn btn-dark rounded-pill px-4 py-2" style="cursor: pointer;">JOIN NOW!</a>
        </div>
    </div>
    
</section>
@endsection
