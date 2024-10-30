@extends('../layoutmaster')

@section('title', 'Halaman Utama')

@section('content')

<div class="d-flex align-items-center vh-100 justify-content-center">
    <div class="d-flex flex-column text-center mb-5 text-danger">
        <div id="lottie-container" class="mt-2"></div>
        <i class="fa-solid fa-ban fa-10x mb-2 "></i>
        <h1>403</h1>
        <h3>{{ $exception->getMessage() ?: 'You don`t have permission to access' }}</h3>
        <a href="{{ url('/') }}" class="mt-5 col-6 align-self-center">
            <button class="btn rounded-5 btn-dark px-4 w-100">
                Return Back
            </button>
        </a>
    </div>
</div>

@endsection
