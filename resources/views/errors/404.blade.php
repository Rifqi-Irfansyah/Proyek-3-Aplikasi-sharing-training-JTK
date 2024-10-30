@extends('../layoutmaster')

@section('title', 'Halaman Utama')

@section('content')

<div class="d-flex align-items-center vh-100 justify-content-center">
    <div class="d-flex flex-column text-center mb-5">
        <div id="lottie-container" class="mt-2"></div>
        <div class="div d-flex justify-content-center">
            <i class="fa fa-question fa-10x mb-2 me-2"></i>
            <i class="fa fa-question fa-10x mb-2 ms-2"></i>
        </div>
        <h1>404</h1>
        <h4>Page Not Found</h4>
        @if (isset($exception['message']) && $exception['message'] !== 'modul')
        <a href="{{ url('/') }}" class="mt-5 col-6 align-self-center w-auto">
            <button class="btn rounded-5 btn-dark px-5 w-100">
                Return Back
            </button>
        </a>
        @endif
    </div>
</div>

@endsection
