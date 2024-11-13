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
                    <a class="nav-link {{ request()->routeIs('berandaTrainer') ? 'text-white' : '' }}"
                        style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="{{ route('berandaTrainer') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <a class="nav-link {{ request()->routeIs('approvetrainer') ? 'text-white' : '' }}"
                        style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="#">
                        <i class="fas fa-check"></i> Your Training
                    </a>
                <li class="nav-link nav-item">
                    <a class="nav-link {{ request()->routeIs('listModul') ? 'text-white' : '' }}"
                        style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="{{ route('listModul') }}">
                        <i class="fas fa-book"></i> Learning Module
                    </a>
                </li>
                </li>
                <li class="nav-link nav-item">
                    <a class="nav-link" style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="#">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <div class="dropdown">
                        <a class="nav-link align-items-center" style="font-size: 0.9rem; display: flex; gap: 8px;" href="{{ route('login') }}" id="dropdownMenuButton">
                            <i class="fas fa-user"></i> Profile
                        </a>
                        <ul class="dropdown-menu px-3 rounded-2" aria-labelledby="dropdownMenuButton">
                            <li class="d-flex align-items-center">
                                <div class="col">
                                    <span class='h6'>{{ Auth::user()->name }}</span>
                                    <span>{{ Auth::user()->email }}</span>
                                    <h6>Role : <span>{{ Auth::user()->role }}</span>
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-item px-0 rounded-3" href="{{ route('logout') }}">Logout</a>
                            </li>
                        </ul>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>