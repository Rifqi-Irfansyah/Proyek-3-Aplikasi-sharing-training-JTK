@extends('../layoutmaster')
@section('title', 'Buat Training')

@section('content')
@include('admin.topbar')
<div class="container d-flex justify-content-center align-items-center min-vh-100 mt-3 mb-5">
    <div class="row justify-content-center w-100">
        <div class="col-md-8">
            <div class="rounded-5 p-5 shadow box-area bg-white text-center position-relative">
                <a href="{{ route('login') }}" class="btn btn-back rounded-circle position-absolute" style="top: 20px; left: 20px; width: 35px; height: 35px; display: flex; justify-content: center; align-items: center;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="fw-bolder mb-4" style="font-size: 2em">Create New Training</h1>
                <form action="{{ route('training.store') }}" method="POST" class="w-100">
                    @csrf
                    <div class="form-group mb-3 text-start">
                        <label for="judul_training" class="form-label">Training Name</label>
                        <input type="text" class="form-control rounded-5" id="judul_training" name="judul_training" required>
                    </div>

                    <div class="form-group mb-3 text-start">
                        <label for="jumlah_pertemuan" class="form-label">Number of Meetings</label>
                        <input type="number" class="form-control rounded-5" id="jumlah_pertemuan" name="jumlah_pertemuan" min="1" required>
                    </div>

                    <div class="form-group mb-3 text-start">
                        <label for="kuota" class="form-label">Quota of Trainee</label>
                        <input type="number" class="form-control rounded-5" id="kuota" name="kuota" min="1" required>
                    </div>

                    <div class="form-group mb-3 text-start">
                        <label for="deskripsi" class="form-label">Training Description</label>
                        <textarea class="form-control rounded-5" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-lg w-100 fs-6 rounded-5 mt-3" style="background-color: #6cace4; color: white; transition: background-color 0.3s, transform 0.2s;"
                        onmouseover="this.style.backgroundColor='#5aabbf'; this.style.transform='scale(1.05)';"
                        onmouseout="this.style.backgroundColor='#6cace4'; this.style.transform='scale(1)';">
                        Create Training
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('footer')
@endsection
