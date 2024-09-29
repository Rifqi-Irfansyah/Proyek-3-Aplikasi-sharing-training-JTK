@extends('trainer.detail_training.sidebar')

@section('title', 'Modul Page')
@section('modulSelect', 'hovered')
@section('isi')
<!-- Main content -->
<div class="content bg-background_putih ms-300 w-100 d-flex flex-column align-items-center justify-content-center mb-5">
    <div class="div d-fill">
        <h1>The Training Not Have Modul</h1>
    </div>
    <br>
    <div class="">
        <button class="btn btn-md fs-6 rounded-5 btn-custom py-2 px-4" onClick="buttonAddModul()">
            <i class="fa fa-plus me-2"></i>Upload Modul
        </button>
    </div>
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
        formData.append('id_training', {{$training->id_training}});
        formData.append('title', formValues.title);
        formData.append('file', formValues.file); 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/tambahModul',
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
                var errorMessage = xhr.responseJSON.message || 'There was a problem while saving data';
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
</script>
@endsection