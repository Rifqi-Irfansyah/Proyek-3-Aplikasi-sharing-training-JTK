@extends('../layoutmaster')

@section('title', 'Beranda Admin')

@section('content')


<div class="d-flex flex-column h-100 w-100">
    <div class="w-100">
        @include('admin.topbar')
    </div>

    <div class="container align-self-start">
        <div class="content w-100 mt-5">
            @if($modul->isEmpty())
            <div class="d-flex flex-column align-items-center justify-content-center h-100 mb-5">
                <div class="div ">
                    <h1>The Are No Module</h1>
                </div>
                <br>
                <div class="">
                    <button class="btn btn-md fs-6 rounded-5 btn-custom py-2 px-4" onClick="buttonAddModul()">
                        <i class="fa fa-plus me-2"></i>Upload Module
                    </button>
                </div>
            </div>
            @else
            <div class="align-self-start">
                <h1>Module</h1>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn rounded-5 btn-dark py-2 me-5" onClick="buttonAddModul()">
                    <i class="fa fa-plus me-1"></i>Upload Module
                </button>
            </div>


            <div class="row mt-2 px-5 justify-content-center">
                @foreach($modul as $file)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10 mt-2">
                    <div class="card mb-4 rounded-4">
                        <div class="card-body d-flex justify-content-center flex-column align-items-between">
                            <div class="row d-flex align-items-center px-2">
                                <div class="col-2">
                                    <i class="fas fa-file-pdf fa-3x me-3 text-danger"></i>
                                </div>
                                <div class="col-1"></div>
                                <div class="col d-flex flex-column">
                                    <h6 class="mb-3">{{ $file->judul }}</h6>
                                    <div class="div d-flex justify-content-end ">
                                        <a href="#" class="text-custom" id="btn-{{$file->nama_file}}"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Open File"><i
                                                class="fa fa-folder-open me-3 text-custom"></i></a>
                                        <a href="#" class="text-custom" id="btn-edit-{{$file->nama_file}}"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit File"><i
                                                class="fa fa-pencil me-3 text-warning"></i></a>
                                        <a href="#" class="text-custom" id="btn-delete-{{$file->nama_file}}"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Remove File"><i
                                                class="fa fa-trash me-3 text-danger"></i></a>
                                    </div>
                                </div>
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
            var title = "Add Modul\n" + "\n\n";
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
                    formData.append('title', formValues.title);
                    formData.append('file', formValues.file);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('tambahModul')}}",
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
            document.getElementById('btn-edit-{{ $file->nama_file }}').addEventListener('click', function(e) {
                e.preventDefault();
                var title = "Add Modul\n" + "\n\n";
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
                                <input id="input-title" name="title" value="{{ $file->judul }}" type="text" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4">
                            </div>
                        </div>
                        <input id="input-file" name="file" type="file" value="{{ $file->nama_file }}.pdf" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4 mt-4">
                    `,
                        focusConfirm: false,
                        preConfirm: () => {
                            const titleInput = document.getElementById("input-title").value;
                            const fileInput = document.getElementById("input-file").files[0];
                            return {
                                titleInput,
                                fileInput,
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
                        formData.append('name_file', "{{$file->nama_file}}"); 
                        formData.append('title', formValues.titleInput);
                        formData.append('file', formValues.fileInput);

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            }
                        });
                        $.ajax({
                            url: "{{route('editModul')}}",
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
            });
            document.getElementById('btn-delete-{{ $file->nama_file }}').addEventListener('click', function(e) {
                e.preventDefault();
                (async () => {
                    const confirmation = await Swal.fire({
                        icon: "warning",
                        title: "Are You Sure Want Delete",
                        text: " {{ $file->judul }} ?",
                        focusConfirm: false,
                        backdrop: 'rgba(0,0,0,0.9)',
                        showConfirmButton: true,
                        showCancelButton:true,
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
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{route('deleteModul')}}",
                            method: 'DELETE',
                            data: {
                                nameFile: "{{$file -> nama_file}}",
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
                                var errorMessage = xhr.responseJSON.error || xhr.responseJSON.message ||
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
            @endforeach
        });
        </script>

        <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        </script>
    </div>

    <div class="w-100 mt-auto">
        @include('footer')
    </div>
    @endsection