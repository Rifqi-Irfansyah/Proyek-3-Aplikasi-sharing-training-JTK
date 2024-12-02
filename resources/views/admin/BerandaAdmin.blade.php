@extends('../layoutmaster')

@section('title', 'Beranda Admin')

@section('content')

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

        @if(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: "{{ session('warning') }}",
                timer: 5000,
                showConfirmButton: false,
                customClass: {
                    popup: 'popup-warning',
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

<div class="d-flex flex-column min-vh-100">
    @include('admin.topbar')
    <h1 class="container"><br>List Training <br></h1>
    <div class="container">
        <div class="text-end">
            <a href="/admin/usulan">
                <button class="btn btn-light float-right text-end " ><i class="fa fa-comments" aria-hidden="true"></i> View Suggestion</button>
            </a>

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
            @if($info->isEmpty())
                <tr>
                    <td colspan="6" class="text-center text-dark p-5">
                        <i>Currently, there are no trainings.</i>
                    </td>
                </tr>
            @else
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
                        <td class="text-center">{{ \Carbon\Carbon::parse($training->jadwalTrainings->first()->waktu_mulai)->format('l, d M Y') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($training->jadwalTrainings->last()->waktu_selesai)->format('l, d M Y') }}</td>
                        <td class="text-center">{{ $training->status}}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-3 ">
                                    <a href="/detailTraining/{{ $training->id_training }}" class="text-decoration-none text-white"><button class="btn btn-outline-primary "><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                    <form id="deleteForm-{{ $training->id_training }}" action="{{ route('training.delete', $training->id_training) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger deleteButton" data-form-id="deleteForm-{{ $training->id_training}}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                    </form>
                            </div>
                        </td>
                    </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <a href="/training/create">
        <button type="button" class="btn btn-light position-absolute top-100 start-50 translate-middle mt-4 ">
                <i class="fa fa-plus" aria-hidden="true"></i> New Course
        </button>
    </a>

</div>

<br>
<br>
<br>

@include('footer')
</div>

@endsection
