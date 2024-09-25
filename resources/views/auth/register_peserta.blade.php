@extends('../layoutmaster')

@section('title', 'Halaman Utama')

@section('content')

<div class="container-fluid register-container">
    <div class="row justify-content-center align-items-center vh-100"> <!-- Vertically and horizontally centered -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="form-container popup-edit shadow-lg p-4"> <!-- Menggunakan shadow-lg dan padding tambahan -->
                <div class="form-title title mb-4 text-center">Register</div> <!-- Menambahkan margin-bottom dan text-center -->
                <form method="POST" action="{{ route('register.peserta.submit') }}">
                    @csrf
                    <div class="mb-3"> <!-- Menambahkan margin-bottom untuk input form -->
                        <input type="email" name="email" class="custom-input input-text form-control" placeholder="Email" required> <!-- Menambahkan form-control dari Bootstrap -->
                    </div>
                    <div class="mb-3">
                        <input type="text" name="full_name" class="custom-input input-text form-control" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="date" name="date_of_birth" class="custom-input input-text form-control" placeholder="Date of Birth" required>
                    </div>

                    <div class=""> <!-- Flexbox untuk merapikan pilihan gender -->
                        <div class="form-check">
                            <input type="radio" name="gender" value="laki-laki" id="male" class="form-check-input" required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="gender" value="perempuan" id="female" class="form-check-input" required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="custom-input input-text form-control" placeholder="Password" required>
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password_confirmation" class="custom-input input-text form-control" placeholder="Confirm Password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="custom-button btn-custom btn btn-primary">Register as Participant</button> <!-- Menggunakan button bootstrap -->
                    </div>
                </form>
            </div>

        </div>
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
