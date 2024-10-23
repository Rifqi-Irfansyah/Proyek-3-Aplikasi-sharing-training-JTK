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
                    <a class="nav-link {{ request()->routeIs('beranda.admin') ? 'text-white' : '' }}"
                        style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="{{ route('beranda.admin') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <a class="nav-link {{ request()->routeIs('approvetrainer') ? 'text-white' : '' }}"
                        style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="{{ route('approvetrainer') }}">
                        <i class="fas fa-check"></i> Approve Trainer
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <a class="nav-link" style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="{{ route('login') }}">
                        <i class="fas fa-cog"></i> Verification Trainer
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <a class="nav-link {{ request()->routeIs('listtrainer') ? 'text-white' : '' }}"
                        style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="{{ route('listtrainer') }}">
                        <i class="fas fa-list"></i> List Trainer
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <a class="nav-link {{ request()->routeIs('listModul') ? 'text-white' : '' }}"
                        style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;"
                        href="{{ route('listModul') }}">
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