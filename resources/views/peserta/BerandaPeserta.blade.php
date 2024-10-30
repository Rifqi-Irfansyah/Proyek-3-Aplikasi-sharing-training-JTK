@extends ('../layoutmaster')

@section('title', 'Beranda')

@section('content')

<div class="d-flex flex-column min-vh-100">
@include('admin.topbar') {{--Sementara--}}
<div class='container'>
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
                    <a href="{{--{{ $training-> }}--}}" class="btn btn-info float-end ">Select</a>
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


@include('footer')
</div>

@endsection