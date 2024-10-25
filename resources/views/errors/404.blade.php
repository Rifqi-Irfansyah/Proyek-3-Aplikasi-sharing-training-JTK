@extends('../layoutmaster')

@section('title', 'Halaman Utama')

@section('content')

<div class="d-flex align-items-center vh-100 justify-content-center">
    <div class="d-flex flex-column text-center mb-5">
        <div id="lottie-container" class="mt-2"></div>
        <script>
            var animation = lottie.loadAnimation({
                container: document.getElementById('lottie-container'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: "{{asset('asset/animate404.json')}}"
            });
        </script>
        <h2>{{ $exception->getMessage() ?: 'Page Not Found' }}</h2>
        <a href="{{ url('/') }}">
            <button class="col-2 btn rounded-5 btn-dark px-4 w-auto">
                Return Back
            </button>
        </a>
    </div>
</div>

@endsection
