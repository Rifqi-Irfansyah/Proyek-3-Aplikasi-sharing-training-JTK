@extends('../layoutmaster')

@section('title', 'Beranda Admin')

@section('content')

<script>
    document.addEventListener('DOMContentLoaded', function() {
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}", // Menampilkan pesan dari session
            timer: 2000,
            showConfirmButton: false,
            customClass: {
                popup: 'popup-success',
                title: 'title',
            }
        });
    });
    @endif
</script>

<div class="d-flex flex-column min-vh-100">
    @include('admin.topbar')
    <h1 class="container"><br>List Training <br></h1>
    <div class="container">
        <div class="text-end">
            <button class="btn btn-outline-dark float-right text-end ">View Suggestion</button>
        </div>
        <br>
        <br>

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
                            <button type="button" class="btn btn-info">
                                <a href="/detailTraining/{{ $training->id_training }}" class="text-decoration-none text-white">View</a>
                            </button>
                            @method('DELETE')
                            <button type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>
    <button type="button" class="btn btn-light position-absolute top-100 start-50 translate-middle mt-4 ">
        <a href="/training/create">Add New Course</a>
    </button>
</div>

<br>
<br>
<br>    

@include('footer')
</div>

@endsection