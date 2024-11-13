@extends('../layoutmaster')

@section('title', 'BerandaTrainer')

@section('content')
<div class="d-flex flex-column min-vh-100">
    @include('trainer.topbarTrainer')
    
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
        
        <h1 class="pt-5" style="font-size: 8rem !important; font-weight: bold; margin-top: 6rem; margin-bottom: 3rem;">
            <span>Hi,</span>
            <span class="text-primary">{{$nama_trainer}}</span><span>!</span>
        </h1>

        <h1 class="pt-5" style="font-size: 8rem !important; font-weight: bold; margin-top: 2rem;">
            <span>What would you like to </span>
            <span class="text-primary">Train </span>
            <span>Today?</span>
        </h1>
    </div>

    <div style="text-align: center;">
        <h1 class="pt-5" style="font-size: 6rem !important; font-weight: bold; margin-top: 20rem;">
            <span>Available </span>
            <span class="text-primary">Training </span>
        </h1>
    </div>

    <!-- My Training Section -->
    <div class="container pt-5">
        <h2 class="pt-5" style="font-size: 4rem !important; font-weight: bold; margin-top: 10rem;">
            My Training
        </h2>

        <div class="row">
            @if($listTrainingDiajarkan->isEmpty())
                <h4 class="text-center p-5 m-5 text-light"><i><b>You haven't taught any training yet.</b></i></h4>
            @else
                @foreach($listTrainingDiajarkan as $training)
                <div class="col-md-4 mb-5">
                    <div class="card" style="width: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $training->judul_training }}</h5>
                            <p class="card-text">{{ Str::limit($training->deskripsi, 100) }}</p>
                            <a href="{{ route('detailTrainingTrainer', $training->id) }}" class="btn btn-info float-end">Select</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- List Training Section with Show More/Less -->
    <div class="container">
        <h1 class="pt-5" style="font-size: 4rem !important; font-weight: bold; margin-top: 5rem;">
            List Training
        </h1>
        
        <div class="row" id="trainingList">
            @if($listTrainingBelumDiajarkan->isEmpty())
                <h4 class="text-center p-5 m-5 text-light"><i><b>No new training available for you to teach.</b></i></h4>
            @else
                @foreach($listTrainingBelumDiajarkan->take(3) as $trainingView)
                <div class="col-md-4 mb-5 mt-4 training-card">
                    <div class="card w-100" style="height: 230px;">
                        <div class="card-body">
                            <h4 class="card-title pb-4">{{ $trainingView->judul_training }}</h4>
                            <p class="card-text">{{ Str::limit($trainingView->deskripsi, 100) }}</p>
                            <a href="{{ route('tambahkanTrainingTrainer', $trainingView->id) }}" class="btn btn-info float-end">Select</a>
                        </div>
                    </div>
                </div>
                @endforeach

                @foreach($listTrainingBelumDiajarkan->skip(3) as $trainingView)
                <div class="col-md-4 mb-5 mt-4 training-card hidden">
                    <div class="card w-100" style="height: 230px;">
                        <div class="card-body">
                            <h4 class="card-title pb-4">{{ $trainingView->judul_training }}</h4>
                            <p class="card-text">{{ Str::limit($trainingView->deskripsi, 100) }}</p>
                            <a href="{{ route('tambahkanTrainingTrainer', $trainingView->id) }}" class="btn btn-info float-end">Select</a>
                        </div>
                    </div>
                </div>
                @endforeach

                @if($listTrainingBelumDiajarkan->count() > 3)
                <div class="col-12 text-center mt-4">
                    <button id="toggleButton" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                        <span>Show More</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                @endif
            @endif
        </div>
    </div>

    @include('footer')
</div>

<!-- Add this CSS -->
<style>
    .hidden {
        display: none;
    }
    .training-card {
        transition: all 0.3s ease;
    }
</style>

<!-- Add this JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggleButton');
    const hiddenCards = document.querySelectorAll('.training-card.hidden');
    let isExpanded = false;

    if (toggleButton) {
        toggleButton.addEventListener('click', function() {
            isExpanded = !isExpanded;
            
            hiddenCards.forEach(card => {
                card.classList.toggle('hidden');
            });

            // Update button text and icon
            const buttonText = toggleButton.querySelector('span');
            const buttonIcon = toggleButton.querySelector('i');
            
            if (isExpanded) {
                buttonText.textContent = 'Show Less';
                buttonIcon.classList.remove('fa-chevron-down');
                buttonIcon.classList.add('fa-chevron-up');
            } else {
                buttonText.textContent = 'Show More';
                buttonIcon.classList.remove('fa-chevron-up');
                buttonIcon.classList.add('fa-chevron-down');
            }
        });
    }
});
</script>
@endsection