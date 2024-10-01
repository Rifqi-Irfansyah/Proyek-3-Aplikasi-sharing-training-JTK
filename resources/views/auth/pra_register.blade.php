@extends('layoutmaster')

@section('title', 'Pra Register')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-6">
            <div class="rounded-5 p-5 shadow box-area bg-white text-center position-relative">
                <a href="{{ route('login') }}" class="btn btn-back rounded-circle position-absolute" style="top: 20px; left: 20px; width: 35px; height: 35px; display: flex; justify-content: center; align-items: center;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h2 class="fw-bolder mb-5">What would you like to register as?</h2>
                <form action="{{ route('register.trainer') }}" method="get" class="w-100 form-floating mb-3">
                    @csrf
                    <button class="btn btn-lg w-100 fs-6 rounded-5" style="background-color: #6cace4; color: white;">
                        Trainer
                    </button>
                </form>

                <form action="{{ route('register.peserta') }}" method="get" class="w-100 form-floating">
                    @csrf
                    <button class="btn btn-md w-100 fs-6 rounded-5 btn-custom" style="background-color: #6cace4; color: white;">
                        Participant
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
