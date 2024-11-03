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
                <a href="{{ route('beranda_peserta') }}" class="btn btn-back btn-md fs-6 rounded-5 py-2 w-50px h-50px">
                    <i class="fa-solid fa-angle-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-item @yield('aboutSelect')">
                <a href="/detailTrainingPeserta/{{$training->id_training}}" class="menu-link fw-bold d-flex justify-content-center me-3">
                    <span>About Training</span>
                </a>
            </li>

            <li class="menu-item @yield('modulSelect')">
                <a href="/modulPeserta/{{$training->id_training}}" class="menu-link fw-bold d-flex justify-content-center me-3">
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
                    <a href="/detailMeetPeserta/{{$jadwal->id_jadwal}}" class="menu-link fw-bold d-flex justify-content-center me-3">
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
    const circleButton = document.querySelector('.circle-button');

    const sidebarState = localStorage.getItem('sidebarCollapsed');
    if (sidebarState === 'true') {
        sidebar.classList.add('collapsed');
    }

    circleButton.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
    });
    const currentPath = window.location.pathname;
    document.querySelectorAll('.menu-item').forEach(item => {
        const link = item.querySelector('a');
        if (link && link.getAttribute('href') === currentPath) {
            item.classList.add('active');
        }
    });
});
</script>
