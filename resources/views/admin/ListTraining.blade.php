@extends('../layoutmaster')

@section('title', 'List Training')

@section('content')

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-6 m-5 rounded-4 d-flex flex-column left-box">
            <div id="lottie-container" style="opacity: 0.4;"></div>      
            <script>
                var animation = lottie.loadAnimation({
                    container: document.getElementById('lottie-container'),
                    renderer: 'svg', 
                    loop: true,
                    autoplay: true,
                    path: '{{ asset('asset/animatelogin.json') }}'
                });

                // Menghentikan animasi setelah lottie selesai diload
                animation.addEventListener('DOMLoaded', function() {
                    animation.stop();
                });
            </script>
        </div>

@endsection