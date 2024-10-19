@extends('../layoutmaster')

@section('title', 'Beranda Admin')

@section('content')


<div class="d-flex align-items-center align-content-between flex-wrap h-100 w-100">
    <div class="w-100">
        @include('admin.topbar')
    </div>

    <div class="container d-flex">
        <div class="content w-100 d-flex flex-column">
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
            <div class="text-center justify-content-start">
                <h1>Module</h1>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-md rounded-5 btn-custom py-2 me-5" onClick="buttonAddModul()">
                    <i class="fa fa-plus me-1"></i>Upload Module
                </button>
            </div>


            <div class="row mt-2 px-5">
                @foreach($modul as $file)
                <div class="col-4 mt-2">
                    <div class="card mb-4 rounded-4">
                        <div class="card-body d-flex justify-content-center flex-column align-items-center">
                            <h5 class="card-title">{{ $file->judul }}</h5>
                            <a href="#" class="btn btn-confirm" id="btn-{{$file->nama_file}}">Open File</a>
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
            @endforeach
        });
        </script>
    </div>

    <div class="w-100">
        @include('footer')
    </div>
    @endsection