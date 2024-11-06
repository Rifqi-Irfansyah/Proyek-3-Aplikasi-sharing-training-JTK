@extends('../layoutmaster')

@section('title', 'Halaman Utama')

@section('content')
<div class="container-fluid p-0 m-0 d-flex min-vh-100">
    <div class="sidebar-new" id="sidebar">
        <div class="sidebar-header d-flex flex-column align-items-start">
            <div class="d-flex align-items-center">
                <img src="{{ asset('asset/logo.png') }}" class="ms-4" alt="logo" style="width: 50px;">
                <span class="title text-black ps-0 me-4">TRAINIFY</span>
            </div>
            <div class="mt-2">
                <a href="{{ route('beranda_peserta') }}"
                   class="btn btn-back btn-md fs-6 rounded-circle py-2 px-3 w-50px h-50px"
                   style="background-color: #343a40; color: #f8f9fa; border: 1px solid #343a40;">
                    <i class="fa-solid fa-angle-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-item @yield('aboutSelect')">
                <a href="/detailTrainingPeserta/{{$training->id_training}}" class="menu-link fw-bold d-flex justify-content-center me-3 btn btn-custom">
                    <span>About Training</span>
                </a>
            </li>

            <li class="menu-item @yield('modulSelect')">
                <a href="/modulPeserta/{{$training->id_training}}" class="menu-link fw-bold d-flex justify-content-center me-3 btn btn-custom">
                    <span>Module</span>
                </a>
            </li>

            @foreach($training->jadwalTrainings as $index => $jadwal)
                @php
                    $number = $index + 1;
                    $suffix = ($number % 10 == 1 && $number % 100 != 11) ? 'st' :
                            (($number % 10 == 2 && $number % 100 != 12) ? 'nd' :
                            (($number % 10 == 3 && $number % 100 != 13) ? 'rd' : 'th'));
                @endphp
                <li class="menu-item @yield($jadwal->id_jadwal)">
                    <a href="/detailMeetPeserta/{{$jadwal->id_jadwal}}" class="menu-link fw-bold d-flex justify-content-center me-3 btn btn-custom">
                        <span>{{ $number . $suffix }} Meet</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    @yield('isi')
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const currentPath = window.location.pathname;

    const sidebarState = localStorage.getItem('sidebarCollapsed');
    if (sidebarState === 'true') {
        sidebar.classList.add('collapsed');
    }

    const circleButton = document.querySelector('.circle-button');
    if (circleButton) {
        circleButton.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        });
    }

    document.querySelectorAll('.menu-item a').forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.remove('btn-custom');
            link.classList.add('btn-dark');
        }
    });
});
</script>

<style>

    .sidebar-new {
        height: 100vh;
        overflow-y: auto;
    }

    .sidebar-menu {
        padding-bottom: 20px;
    }

    .sidebar-menu .menu-item .menu-link.btn-custom {
        background-color: #84A3E0 !important;
        color: #fff !important;
        border: none;
    }

    .sidebar-menu .menu-item .menu-link.btn-dark {
        background-color: #343a40 !important;
        color: #fff !important;
    }


    .sidebar-new::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar-new::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-new::-webkit-scrollbar-thumb {
        background-color: #c3c3c3;
        border-radius: 10px;
        border: 3px solid transparent;
    }

    .sidebar-new::-webkit-scrollbar-thumb:hover {
        background-color: #999;
    }
</style>

@endsection
