@extends('../layoutmaster')

@section('title', 'Halaman Utama')

@section('content')

<!-- FAILED LOGIN POP UP MODAL -->
<script>
@if(session('error'))
var errorMessage = "{{ Session::get('error') }}";
Swal.fire({
    icon: 'error',
    title: 'Login Failed',
    text: errorMessage,
    confirmButtonText: 'OK',
    customClass: {
        popup: 'popup-error',
        confirmButton: 'btn-confirm',
        title: 'title',
        color: '#DE2323',
    }
})
@endif
</script>
<!-- END FAILED LOGIN POP UP MODAL -->
     
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-6 m-5rounded-4 d-flex flex-column left-box">
            <div id="lottie-container" ></div>      
            <script>
                var animation = lottie.loadAnimation({
                    container: document.getElementById('lottie-container'),
                    renderer: 'svg', 
                    loop: true,
                    autoplay: true,
                    path: "{{asset('asset/animatelogin.json')}}"
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
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email"
                            class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4" placeholder="Email" required="">
                            
                    </div>
                    <div class="input-group mb-4 align-items-center">
                        <input type="password" name="password" id="passwordInput"
                            class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4" placeholder="Password" required="">

                            <div id="showPassword" style="cursor:pointer; transform: translateX(-40px); margin-right:-25px; z-index:100;" >
                                <img id="icon" src="{{ asset('asset/eye.svg') }}" width="23" height="23" class =""/>
                            </div>
                    </div>
                    <div class="input-group mb-5 justify-content-center">
                        <button class="btn btn-md w-50 fs-6 rounded-5 btn-custom">Login</button>
                    </div>
                </form>
                <div class="text-center text-secondary">
                    <small>Don't have account? <a href="#" class ="text-decoration-none">Sign Up</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var eyeicon = document.getElementById("showPassword");
    var passwordInput = document.getElementById('passwordInput');
    var svgIcon = document.getElementById('icon');

    eyeicon.onclick = function (){
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            svgIcon.src = '{{ asset('asset/eye-slash.svg') }}';
        } else {
            passwordInput.type = 'password';
            svgIcon.src = '{{ asset('asset/eye.svg') }}';
        }
    }
</script>

@endsection