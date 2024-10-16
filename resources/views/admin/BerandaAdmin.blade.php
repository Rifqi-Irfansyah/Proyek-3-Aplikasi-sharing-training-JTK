@extends('../layoutmaster')

@section('title', 'Beranda Admin')

@section('content')
@include('admin.topbar')

<h1 class="container"><br>List Training <br></h1>


<div class="container">
    <div class="text-end">
        <button class="btn btn-outline-dark float-right text-end ">View Suggestion</button>
    </div>
    <br><br>

    <table class="table table-default table-hover"  style="border-radius: 10px; overflow: hidden;">
        <thead class="table-primary" >
            <th class="text-center">Training Name</td>
            <th class="text-center">Trainer Name</td>
            <th class="text-center">Start Date</td>
            <th class="text-center">End Date</td>
            <th class="text-center">Status</td>
            <th class="text-center">Action</td>
        </thead >
        <tbody>
        @foreach ($info as $training)
                <tr>
                    <td class="text-center">{{ $training->judul_training }}</td>
                    <td class="text-center">
                        @if($training->user)
                {{ $training->user->name }}
            @else
                <span class="text-muted">No Trainer Yet</span>
            @endif
                    </td>
                    <td class="text-center">{{ $training->jadwalTrainings->first()->waktu_mulai }}</td>
                    <td class="text-center">{{ $training->jadwalTrainings->last()->waktu_selesai }}</td>
                    <td class="text-center">{{ $training->status }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info"><a href="/detailTraining/{{ $training->id_training }}">View</a></button>
                            <button type="button" class="btn btn-success">Edit</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="container">
    <button type="button" class="btn btn-light">Add New Course
        {{-- <a href="{{ route('admin.training.create') }}">Create Training</a> --}}
    </button>
</div>
<br>
<br>
<br>    

@include('footer')
@endsection