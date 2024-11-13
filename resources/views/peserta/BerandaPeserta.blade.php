@extends ('../layoutmaster')

@section('title', 'Beranda')


@section('content')

<div class="d-flex flex-column min-vh-100">
@include('peserta.topbarPeserta')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false,
                customClass: {
                    popup: 'popup-success',
                    title: 'title',
                }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                timer: 2000,
                showConfirmButton: false,
                customClass: {
                    popup: 'popup-error',
                    title: 'title',
                }
            });
        @endif


        document.querySelectorAll('.deleteButton').forEach(function(button) {
            button.addEventListener('click', function (event) {
                const formId = this.getAttribute('data-form-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(formId).submit();
                    }
                });
            });
        });
    });
</script>


<div class='container'>

    
    
    <h1 class=" pt-5">
        <span>Hi,</span>
        <span class="text-primary">{{$nama}}</span><span>!</span>
    </h1>
    <h1 class="pt-2">
        <span>What would you like to </span>
        <span class="text-primary">Learn </span>
        <span>Today?</span>
    </h1>
</div>

<div class = 'container pt-5'>
    <h2 class="pb-5">My Training</h2>
    <div class='row'>
        @if($trainingDiikuti->isEmpty())
            <h4 class="text-center p-5 m-5 text-light"><i><b>You haven’t joined any training yet.</b></i></h4>
        @else
            @foreach($trainingDiikuti as $training)
            <div class = 'col-md-4 mb-5'>
                <div class="card w-100 rounded-5" style="height: 230px;">
                    <div class="card-body">
                    <h5 class="card-title">{{ $training->judul_training }}</h5>
                    <p class="card-text">{{ Str::limit($training->deskripsi,100) }}</p>
                    <a href="/detailTrainingPeserta/{{ $training->id_training }}" class="btn btn-info float-end rounded-5">Select</a>
                </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>

</div>

<div class='container'>
    <h1>List Training</h1>

    <div class='row'>
        @if($trainingBelumDiikuti->isEmpty())
            <h4 class="text-center p-5 m-5 text-light"><i><b>No training available. </b></i></h4>
        @else
            @foreach($trainingBelumDiikuti as $trainingView)
            @if($trainingView->kuota>30)

            @else
            <div class = 'col-md-4 mb-5 mt-4'>
                <div class="card w-100 rounded-5" style="height: 230px;">
                    <div class="card-body">
                    <h4 class="card-title pb-4">{{ $trainingView->judul_training }}</h4>
                    <p class="card-text">{{ Str::limit($trainingView->deskripsi,100) }}</p>
                    <a href="{{--{{ $training-> }}--}}" class="btn btn-info float-end rounded-5">Select</a>
                    </div>
                </div>
            </div>
            @endif

            @endforeach
        @endif
    </div>
</div>
<div class="container pt-5 pb-5">
    <h3 class="pb-3">Help Us Improve Trainify with Your Ideas</h3>
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