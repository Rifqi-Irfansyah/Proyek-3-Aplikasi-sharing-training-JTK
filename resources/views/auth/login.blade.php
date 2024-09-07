@extends('../layoutmaster')

@section('title', 'Halaman Utama')

@section('content')
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-6 m-5rounded-4 d-flex flex-column left-box">
            <!-- <div id="lottie-container" class="featured-image mb-3">
                
            </div> -->
            <div id="lottie-container" ></div>
            
            <script>
                var animation = lottie.loadAnimation({
                    container: document.getElementById('lottie-container'),
                    renderer: 'svg', 
                    loop: true,
                    autoplay: true,
                    path: '{{ asset('asset/animatelogin.json') }}'
                });
            </script>
        </div>

        <div class="col-md-5 ps-5 right-box row align-items-center">
            <div class="rounded-5 px-5 py-3 shadow box-area bg-white">
                <div class="header-text mb-5 justify-center text-center w-100">
                    <h2 class="fw-bolder">Login</h2>
                </div>
                <form action="{{route('loginaksi')}}" method="post" autocomplete="off" class="w-100 form-floating">
                    @csrf
                    <div class="input-group mb-3 ">
                        <input type="text" name="username" id="username"
                            class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4" placeholder="Username">
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" name="password"
                            class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4" placeholder="Password">
                    </div>
                    <div class="input-group mb-5 justify-content-center">
                        <button class="btn btn-md btn-primary w-50 fs-6 rounded-5 bg-custom">Login</button>
                    </div>
                </form>
                <div class="row text-secondary">
                    <small>Don't have account?<a href="#" class ="text-decoration-none">Sign Up</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection