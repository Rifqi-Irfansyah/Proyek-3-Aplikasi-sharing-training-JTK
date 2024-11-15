@extends('../layoutmaster')

@section('title', 'Topbar')

@section('content')

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
                    <a class="nav-link {{ request()->routeIs('beranda_peserta') ? 'text-white' : '' }}"
                        style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="{{ route('beranda_peserta') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>

                <li class="nav-link nav-item">
                    <div class="dropdown">
                        <a class="nav-link align-items-center" style="font-size: 0.9rem; display: flex; gap: 8px;" href="{{ route('login') }}" id="dropdownMenuButton">
                            <i class="fas fa-user"></i> Profile
                        </a>
                        <ul class="dropdown-menu px-3 rounded-2" aria-labelledby="dropdownMenuButton">
                            <li>
                                <i class="mx-2 fa-solid fa-user"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </li>
                            <li>
                                <i class="mx-2 fa-solid fa-envelope"></i>
                                <span>{{ Auth::user()->email }}</span>
                            </li>
                            <li>
                                <i class="mx-2 fa-solid fa-gear"></i>
                                Role : <span>{{ Auth::user()->role }}</span>
                            </li>
                            <li class="mt-3">
                                <a class="dropdown-item px-0 rounded-3" href="{{ route('logout') }}">
                                    <i class="mx-2 fa-solid fa-right-from-bracket"></i>Logout
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>