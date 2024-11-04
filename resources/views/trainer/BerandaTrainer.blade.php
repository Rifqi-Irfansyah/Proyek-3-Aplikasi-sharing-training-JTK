@extends ('../layoutmaster')

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
    
    <h1 class=" pt-5">
      <span>Hi,</span>
      <span class="text-primary">{{$nama_trainer}}</span><span>!</span>
    </h1>
    <h1 class="pt-2">
      <span>What would you like to </span>
      <span class="text-primary">Train </span>
      <span>Today?</span>
    </h1>   
  </div>

  <div class = 'container pt-5'>
    <h2>My Training</h2>
    <div class='row'>
      @if($listTrainingDiajarkan->isEmpty())
        <h4 class="text-center p-5 m-5 text-light"><i><b>You haven't taught any training yet.</b></i></h4>
      @else
        @foreach($listTrainingDiajarkan as $training)
        <div class = 'col-md-4 mb-5'>
          <div class="card" style="width: 20rem;">
            <div class="card-body">
              <h5 class="card-title">{{ $training->judul_training }}</h5>
              <p class="card-text">{{ Str::limit($training->deskripsi,100) }}</p>
              <a href="{{ route('detailTrainingTrainer', $training->id) }}" class="btn btn-info float-end">Select</a>
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
      @if($listTrainingBelumDiajarkan->isEmpty())
        <h4 class="text-center p-5 m-5 text-light"><i><b>No new training available for you to teach. </b></i></h4>
      @else
        @foreach($listTrainingBelumDiajarkan as $trainingView)
        <div class = 'col-md-4 mb-5 mt-4'>
          <div class="card w-100" style="height: 230px;">
            <div class="card-body">
              <h4 class="card-title pb-4">{{ $trainingView->judul_training }}</h4>
              <p class="card-text">{{ Str::limit($trainingView->deskripsi,100) }}</p>
              <a href="{{ route('tambahkanTrainingTrainer', $trainingView->id) }}" class="btn btn-info float-end">Select</a>
            </div>
          </div>  
        </div>
        @endforeach
      @endif
    </div>
  </div>

  <div class="container pt-5 pb-5">
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