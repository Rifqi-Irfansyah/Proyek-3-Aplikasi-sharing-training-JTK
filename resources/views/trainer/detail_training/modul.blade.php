@extends('trainer.detail_training.sidebar')

@section('title', 'Modul Page')
@section('modulSelect', 'hovered')
@section('isi')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session('success'))
const successMessage = "{{Session::get('success')}}";
Swal.fire({
    icon: 'success',
    title: 'Module Added Success!',
    text: successMessage,
    showConfirmButton: false,
    backdrop: 'rgba(0,0,0,0.8)',
    timer: 2000,
    customClass: {
        popup: 'popup-success',
        title: 'title',
        color: '#DE2323'
    }
})
@endif
</script>

<!-- Main content -->
<div class="content bg-custom-pattern ms-300 w-100 d-flex flex-column">
    @if($modul->isEmpty())
    <div class="d-flex flex-column align-items-center justify-content-center h-100 mb-5">
        <div class="div ">
            <h1>The Training Not Have Module</h1>
        </div>
        <br>
        <div class="">
            <button class="btn btn-md rounded-5 btn-custom py-2 me-2" onClick="buttonAddFromList()">
                <i class="fa fa-plus me-1"></i>Add From List
            </button>
            <button class="btn btn-md fs-6 rounded-5 btn-custom py-2 px-4" onClick="buttonAddModul()">
                <i class="fa fa-plus me-2"></i>Upload Module
            </button>
        </div>
    </div>
    @else
    <div class="text-center mt-5">
        <h1>Module Training</h1>
    </div>
    <div class="d-flex justify-content-end">
        <button class="btn btn-md rounded-5 btn-custom py-2 me-2" onClick="buttonAddFromList()">
            <i class="fa fa-plus me-1"></i>Add From List
        </button>
        <button class="btn btn-md rounded-5 btn-custom py-2 me-5" onClick="buttonAddModul()">
            <i class="fa fa-plus me-1"></i>Upload Module
        </button>
    </div>


    <div class="row mt-2 px-5">
        @foreach($modul as $file)
        <div class="col-lg-4 col-md-6 col-sm-12 mt-2">
            <div class="card border-primary mb-4 rounded-4 ">
                <div class="card-body d-flex justify-content-center flex-column align-items-center">
                    <i class="fas fa-file-pdf fa-3x me-3 text-danger"></i>
                    <h5 class="card-title my-2">{{ $file->judul }}</h5>
                    <div class="d-flex">
                        <a href="#" type="button" class="btn btn-outline-primary bordered-2 rounded-5 mx-1" id="btn-{{$file->nama_file}}">
                            <i class="fa fa-folder-open me-2 text-warning"></i>Open
                        </a>
                        <a href="#" type="button" class="btn btn-outline-danger rounded-5 mx-1 btn-delete" data-file="{{$file}}">
                            <i class="fa fa-trash me-2 text-danger"></i>Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>

<script>
function buttonAddModul() {
    var title = "Add Modul\n" + "<?php echo $training->judul_training; ?>" + "\n\n";
    (async () => {
        const {
            value: formValues
        } = await Swal.fire({
            title: title,
            backdrop: 'rgba(0,0,0,0.8)',
            confirmButtonText: 'Submit',
            html: `
            <div class="row">
                <div class="col-3 d-flex align-self-center">
                    Title File
                </div>
                <div class="col">
                    <input id="input-title" name="title" type="text" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                </div>
            </div>
            <input id="input-file" name="file" type="file" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4 mt-4">
        `,
            focusConfirm: false,
            preConfirm: () => {
                const titleInput = document.getElementById("input-title").value;
                const fileInput = document.getElementById("input-file");

                if (!fileInput.files.length) {
                    Swal.showValidationMessage('Please select a file!');
                    return false;
                }
                return {
                    title: titleInput,
                    file: fileInput.files[0]
                };
            },
            customClass: {
                popup: 'popup-edit',
                confirmButton: 'btn-confirm',
                title: 'title',
                color: '#DE2323',
            }
        });

        if (formValues) {
            const formData = new FormData();
            formData.append('id_training', {{$training -> id_training}});
            formData.append('title', formValues.title);
            formData.append('file', formValues.file);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('tambahModulTraining')}}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    location.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success Saved!',
                        text: 'Meet has been added',
                        showConfirmButton: false,
                        backdrop: 'rgba(0,0,0,0.8)',
                        timer: 1000,
                        customClass: {
                            popup: 'popup-success',
                            title: 'title',
                            color: '#DE2323',
                        }
                    });
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON.message ||
                        'There was a problem while saving data';
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed Upload!',
                        text: errorMessage,
                        backdrop: 'rgba(0,0,0,0.8)',
                        customClass: {
                            popup: 'popup-error',
                            confirmButton: 'btn-confirm',
                            title: 'title',
                            color: '#DE2323',
                        }
                    });
                }
            });
        }
    })();

}

function buttonAddFromList() {
    var title = "Add Modul\n" + "<?php echo $training->judul_training; ?>" + "\n\n";
    (async () => {
        const {
            value: formValues
        } = await Swal.fire({
            title: title,
            backdrop: 'rgba(0,0,0,0.8)',
            showConfirmButton: false,
            html: `
                <form action="{{route('addModulFromList', ['id' => $training->id_training]) }}" method="POST">
                    @csrf
                    <div class="d-flex container row justify-content-center" id="modulContainer">
                    @foreach($modulGlobal as $file)
                    <div class="d-flex col-xl-3 col-lg-4 col-md-6 col-sm-10 mt-2">
                        <div class="card mb-4 rounded-4 align-self-center">
                            <div class="card-body d-flex justify-content-center flex-column align-items-between">
                                <div class="row d-flex align-items-center px-2">
                                    <div class="col-1">
                                        <input type="checkbox" name="selected_files[]" value="{{ $file->nama_file }}">
                                    </div>
                                    <div class="col-1">
                                        <i class="fas fa-file-pdf fa-2x me-3 text-danger"></i>
                                    </div>
                                    <div class="col d-flex flex-column ms-2">
                                        <h6>{{ $file->judul }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                    <button type="submit" class="btn btn-custom mt-3 w-auto rounded-5">Submit Selected</button>
                </form>
            `,
            focusConfirm: false,
            customClass: {
                popup: 'popup-edit',
                title: 'title',
                color: '#DE2323',
            }
        });
    })();
}

document.addEventListener('DOMContentLoaded', function() {
    @foreach($modul as $file)
    document.getElementById('btn-{{ $file->nama_file }}').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            showConfirmButton: false,
            html: `
                <embed type="application/pdf" src="{{ asset('storage/uploads/' . $file->nama_file) }}" class="full-size"></embed>
            `,
            focusConfirm: false,
            backdrop: 'rgba(0,0,0,0.9)',
            showCloseButton: true,
            customClass: {
                popup: 'popup-modul',
                confirmButton: 'btn-confirm',
                title: 'title',
                color: '#DE2323',
            }
        });
    });
    @endforeach

    $(document).on('click', ".btn-delete", function(e) {
        e.preventDefault();
        let file = JSON.parse(this.getAttribute('data-file'));
        (async () => {
            const confirmation = await Swal.fire({
                icon: "warning",
                title: "Are You Sure Want Delete",
                text: file.judul+" ?",
                focusConfirm: false,
                backdrop: 'rgba(0,0,0,0.9)',
                showConfirmButton: true,
                showCancelButton: true,
                customClass: {
                    popup: 'popup-warning',
                    confirmButton: 'btn-cancel',
                    cancelButton: 'btn-confirm',
                    title: 'title',
                    color: '#DE2323',
                }
            });

            if (confirmation.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    }
                });
                $.ajax({
                    url: "{{route('deleteModulTraining', '')}}/" + "{{$training->id_training}}",
                    method: 'DELETE',
                    data: {
                        nameFile: file.nama_file,
                    },
                    success: function(response) {
                        location.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Success Deleted!',
                            text: 'Modul have been deleted',
                            showConfirmButton: false,
                            backdrop: 'rgba(0,0,0,0.8)',
                            timer: 2000,
                            customClass: {
                                popup: 'popup-success',
                                title: 'title',
                                color: '#DE2323',
                            }
                        })
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.error || xhr
                            .responseJSON.message ||
                            'There was problem while deleted data';
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed Deleted!',
                            text: errorMessage,
                            backdrop: 'rgba(0,0,0,0.8)',
                            customClass: {
                                popup: 'popup-error',
                                confirmButton: 'btn-confirm',
                                title: 'title',
                                color: '#DE2323',
                            }
                        })
                    }
                });
            }
        })();
    });
});
</script>
@endsection