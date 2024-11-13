@extends('../layoutmaster')

@section('title', 'Preview Training')

@section('content')
@include('peserta.topbarPeserta')
<section class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center">
        <button class="btn btn-back btn-md fs-5 rounded-5 py-2 w-50px h-50px">
        <i class="fa-solid fa-angle-left" aria-hidden="true"></i>
        </button>
        <h1 class="text-center flex-grow-1">DIGITAL MARKETING</h1>
    </div>

    <div class="card mt-4 p-4" style="border-radius: 70px">
        <div class="row">
            <div class="col-md-6 text-center">
                <h3>About Training</h3>
                <p>Digital marketing adalah proses pemasaran menggunakan teknologi digital seperti internet, perangkat seluler, dan media digital lainnya.
                    Training ini bertujuan untuk memberikan pemahaman tentang konsep dasar digital marketing, mengenalkan platform-platform utama,
                    serta cara mengimplementasikan strategi yang tepat guna meningkatkan penjualan dan brand awareness.
                    Selain itu, peserta akan belajar cara mengukur keberhasilan strategi digital yang dijalankan.</p>
            </div>
            <div class="col-md-6 text-center">
                <p>Pelatihan digital marketing mencakup lima modul utama. Modul pertama membahas konsep digital marketing, perbedaannya dengan pemasaran tradisional,
                    serta tren terbaru seperti media sosial, SEO, dan email marketing. Modul kedua fokus pada platform utama seperti website yang SEO-friendly, media sosial,
                    dan Google Ads. Modul ketiga membahas content marketing, termasuk pembuatan konten yang efektif dan pengelolaan content calendar. Modul keempat mengupas email marketing,
                    dengan fokus pada kampanye, automasi, dan segmentasi. Modul kelima membahas pengukuran kinerja digital marketing menggunakan Google Analytics dan Facebook Insights.</p>
            </div>
        </div>

        <div class="text-center mt-4">
            <i class="fas fa-user"></i><strong>Trainer</strong><p><br>Dio Rahman Putra</p>
            <p><strong>Timeline Training</strong> <br> 2 Bulan - 7 Pertemuan - Online/Offline</p>
            <!-- Menambahkan ID pada tombol -->
            <a id="joinNowButton" class="btn btn-dark rounded-pill px-4 py-2" style="cursor: pointer;">JOIN NOW!</a>
        </div>
    </div>

</section>
@include('footer')
@endsection
