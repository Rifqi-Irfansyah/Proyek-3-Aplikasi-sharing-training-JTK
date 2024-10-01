@extends('../layoutmaster')

@section('title', 'Halaman Utama')

@section('content')

@if ($errors->any())
<script>
    @if ($errors->any())
        var errorMessages = @json($errors->all());
        // Joining error messages into a single string for display
        var errorMessage = errorMessages.join('\n');
        Swal.fire({
            icon: 'error',
            title: 'Registration Failed',
            text: errorMessage,
            confirmButtonText: 'OK',
            customClass: {
                popup: 'popup-error',
                confirmButton: 'btn-confirm',
                title: 'title',
                color: '#DE2323',
            }
        });
    @endif
</script>

@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container-fluid register-container">
    <div class="row justify-content-center align-items-center vh-100">
        <!-- Form register trainer -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="form-container popup-edit shadow-lg p-4 rounded-4 bg-white" style="width: 80%; max-width: 600px; border: none;"> <!-- Lebar container diperbesar -->
                <a href="{{ route('register.choice') }}" class="btn btn-back rounded-circle position-absolute" style="top: 20px; left: 20px; width: 35px; height: 35px; display: flex; justify-content: center; align-items: center;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="form-title title mb-4 text-center" style="color: black">Register</div>
                <form method="POST" action="{{ route('register.trainer.submit') }}">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="custom-input input-text form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="full_name" class="custom-input input-text form-control" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="date" name="date_of_birth" class="custom-input input-text form-control" placeholder="Date of Birth" required>
                    </div>

                    <div class="">
                        <div class="form-check">
                            <input type="radio" name="gender" value="laki-laki" id="male" class="form-check-input" required>
                            <label class="form-check-label" style="color: black" for="male">Male</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="gender" value="perempuan" id="female" class="form-check-input" required>
                            <label class="form-check-label" style="color: black" for="female">Female</label>
                        </div>
                    </div>

                    <!-- Input tambahan untuk Kemampuan -->
                    <div class="mb-3">
                        <input type="text" name="kemampuan" class="custom-input input-text form-control" placeholder="Kemampuan" required>
                    </div>

                    <!-- Dropdown untuk Pengalaman -->
                    <div class="mb-3">
                        <select name="pengalaman" class="custom-input input-text form-control" required>
                            <option value="" disabled selected>Pilih Pengalaman</option>
                            <option value="belum ada">Belum Ada</option>
                            <option value="<1 tahun">&lt;1 tahun</option>
                            <option value="1-3 tahun">1-3 tahun</option>
                            <option value="3 tahun +">3 tahun +</option>
                        </select>
                    </div>

                    <!-- Input untuk Nomor WhatsApp -->
                    <div class="mb-3">
                        <input type="tel" name="no_wa" class="custom-input input-text form-control" placeholder="Nomor WhatsApp" pattern="^\+?[0-9]{10,13}$" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="custom-input input-text form-control" placeholder="Password" required>
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password_confirmation" class="custom-input input-text form-control" placeholder="Confirm Password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-md w-100 fs-6 rounded-5 btn-custom" style="background-color: #6cace4; color: white;"> <!-- Sudut tombol dibuat melingkar -->
                            Register as Trainer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Animasi SVG di sebelah form -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="rounded-4 left-box">
                <div id="lottie-container"></div>
                <script>
                    var animation = lottie.loadAnimation({
                        container: document.getElementById('lottie-container'),
                        renderer: 'svg',
                        loop: true,
                        autoplay: true,
                        path: "{{ asset('asset/animateregister.json') }}"
                    });
                </script>
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
