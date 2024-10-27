@extends ('../layoutmaster')

@section('title', 'Beranda')

f

@section('content')

<div class="d-flex flex-column min-vh-100">
@include('peserta.topbarPeserta')
<div class='container'>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
    <br>
    <br>
    <h1>Hi, Nama!</h1>
    <h1>What will you Learn Today?</h1>   
</div>
<br>
<br>
<div class = 'container'>
    <h2>My Training</h2>
    <br>
    <div class='row'>
        @foreach($trainingDiikuti as $training)
        <div class = 'col-md-4 mb-5'>
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                  <h5 class="card-title">{{ $training->judul_training }}</h5>
                  <p class="card-text">{{ Str::limit($training->deskripsi,100) }}</p>
                  {{-- <a href="{{ route('detailTrainingPeserta') }}" class="btn btn-info float-end ">Select</a> --}}
                </div>
            </div>  
        </div>
        @endforeach
    </div>

</div>

<div class='container'>
    <h1>List Training</h1>

    <div class='row'>
        @foreach($trainingBelumDiikuti as $trainingView)
        <div class = 'col-md-4 mb-5 mt-4'>
            <div class="card shadow" style="width: 20rem;">
                <div class="card-body">
                  <h5 class="card-title">{{ $trainingView->judul_training }}</h5>
                  <p class="card-text">{{ Str::limit($trainingView->deskripsi,100) }}</p>
                  <a href="{{--{{ $training-> }}--}}" class="btn btn-info float-end ">Select</a>
                </div>
            </div>  
        </div>
        @endforeach
    </div>
</div>
<div class="container">
    <h3>Make Trainify Better with Your Suggestion :)</h3>
    <form class="custom-form w-25" method="POST" action="{{ route('usulan.store') }}">
        @csrf <!-- Tambahkan token CSRF untuk keamanan -->
        <input type="hidden" name="email_pengusul" value="{{ auth()->user()->email }}">

        <div class="row mb-3">
            <label for="title_of_topic" class="col-form-label">Title of Topic</label>
            <div>
                <input type="text" class="form-control" name="judul_materi" id="title_of_topic" placeholder="Enter title of topic" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="discussion" class="col-form-label">Discussion</label>
            <div>
                <textarea class="form-control" name="bahasan" id="discussion" rows="3" placeholder="Enter discussion details" required></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="suggestion" class="col-form-label">Suggestion</label>
            <div>
                <textarea class="form-control" name="usulan" id="suggestion" rows="3" placeholder="Enter your Suggestion" required></textarea>
            </div>
        </div>

        <div class="row">
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>


@include('footer')
</div>

@endsection