@extends('../layoutmaster')

@section('title', 'Topbar')

@section('content')

<nav class="navbar navbar-expand-lg" style="background-color: #9BBBF2; margin-top: -5px;">
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
                    <a class="nav-link" style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;" href="{{ route('login') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <a class="nav-link" style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;" href="{{ route('login') }}">
                        <i class="fas fa-check"></i> Approve Trainer
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <a class="nav-link" style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;" href="{{ route('login') }}">
                        <i class="fas fa-cog"></i> Verification Trainer
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <a class="nav-link" style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;" href="{{ route('login') }}">
                        <i class="fas fa-list"></i> List Trainer
                    </a>
                </li>
                <li class="nav-link nav-item">
                    <a class="nav-link" style="font-size: 0.9rem; display: flex; align-items: center; gap: 8px;" href="{{ route('login') }}">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
