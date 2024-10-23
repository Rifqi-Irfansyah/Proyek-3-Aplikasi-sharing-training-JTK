@extends('../layoutmaster')

@section('title', 'Footer')

@section('content')
  
<footer class="bg-light py-4 mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-md-4 d-flex align-items-center">
                <img src="{{ asset('asset/logo.png') }}" alt="Logo" style="width: 50px; margin-right: 10px;">
                <div>
                    <h5 class="fw-bold" style="font-size: 14px;">TRAINIFY</h5>
                    <small style="font-size: 12px;">Learning without limits<br>Elevate your skills today</small>
                </div>
            </div>
            <div class="col-md-4">
                <h6 class="fw-bold" style="font-size: 14px;">Social Media</h6>
                <ul class="list-unstyled" style="font-size: 12px;">
                    <li>Instagram: <a href="#">@trainify_education</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="fw-bold" style="font-size: 14px;">Visit Us</h6>
                <address style="font-size: 12px;">
                    Jurusan Teknik Komputer dan Informatika, Politeknik Negeri Bandung. <br>
                    Jl. Gegerkalong Hilir, Desa Ciwawuga,<br>
                    Kecamatan Parongpong, Kabupaten Bandung Barat,<br>
                    Jawa Barat 40559
                </address>
            </div>
        </div>
    </div>
</footer>

