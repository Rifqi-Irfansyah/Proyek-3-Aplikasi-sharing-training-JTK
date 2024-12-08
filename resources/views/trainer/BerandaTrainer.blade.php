@extends ('../layoutmaster')

@section('title', 'Beranda')


@section('content')

<div class="d-flex flex-column min-vh-100">
@include('trainer.topbarTrainer')

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

        @if(session('info'))
            Swal.fire({
                icon: 'success',
                title: 'Info',
                text: "{{ session('info') }}",
                timer: 2000,
                showConfirmButton: false,
                customClass: {
                    popup: 'popup-success',
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
        <span class="text-primary">Teach </span>
        <span>Today?</span>
    </h1>
</div>

<div class = 'container pt-5'>
    <h2 class="pb-5">My Training</h2>
    <div class='row'>
        @if($trainingDiajarkan->isEmpty())
            <h4 class="text-center p-5 m-5 text-light"><i><b>You haven’t joined any training yet.</b></i></h4>
        @else
            @foreach($trainingDiajarkan as $training)
            <div class = 'col-md-4 mb-5'>
                <div class="card w-100 rounded-5" style="height: 230px;">
                    <div class="card-body">
                    <h5 class="card-title">{{ $training->judul_training }}</h5>
                    <p class="card-text">{{ Str::limit($training->deskripsi,100) }}</p>
                    <a href="/detailTraining/{{ $training->id_training }}" class="btn btn-info float-end rounded-5">Select</a>
                </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>

</div>

<div class="container">
    @if($trainingPending->isEmpty())

    @else
        <h2>Pending...</h2>
        <div class="row">
            @foreach($trainingPending as $trainingPendings)
                <div class="col-md-4 mb-5 mt-4">
                    <div class="card w-100 rounded-5" style="height: 230px;">
                        <div class="card-body">
                            <h4 class="card-title pb-4">{{ $trainingPendings->training->judul_training }}</h4>
                            <p class="card-text">{{ Str::limit($trainingPendings->training->deskripsi, 100) }}</p>
                            {{-- <a href="/previewTrainingTrainer/{{ $trainingPendings->training->id_training }}" class="btn btn-info float-end rounded-5">Select</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>


<div class='container'>
    <h1>List Avaliable Training</h1>

    <div class='row'>
        @if($trainingTidakDiajarkan->isEmpty())
            <h4 class="text-center p-5 m-5 text-light"><i><b>No training available. </b></i></h4>
        @else
            @foreach($trainingTidakDiajarkan as $trainingView)
            <div class = 'col-md-4 mb-5 mt-4'>
                <div class="card w-100 rounded-5" style="height: 230px;">
                    <div class="card-body">
                    <h4 class="card-title pb-4">{{ $trainingView->judul_training }}</h4>
                    <p class="card-text">{{ Str::limit($trainingView->deskripsi,100) }}</p>
                    <a href="/previewTrainingTrainer/{{ $trainingView->id_training }}" class="btn btn-info float-end rounded-5">Select</a>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>



@include('footer')
</div>

@endsection