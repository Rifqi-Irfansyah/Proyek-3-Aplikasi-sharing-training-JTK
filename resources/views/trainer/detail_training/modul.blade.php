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
        <button class="btn btn-md fs-6 rounded-5 btn-custom py-2 px-4" onClick="buttonEdit()">
            <i class="fa fa-plus me-2"></i>Add Modul
        </button>
    </div>
</div>
@endsection