@extends('../layoutmaster')

@section('title', 'Halaman Utama')

@section('content')
@if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-6 m-5rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
            style="background: #103cbe;">
            <div class="featured-image mb-3">
                <img src="images/1.png" class="img-fluid" style="width: 250px;">
            </div>
        </div>

        <div class="col-md-6 right-box">
            <div class="row ms-4 align-items-center rounded-5 px-5 py-3 shadow box-area ">
                <div class="header-text mb-4 justify-center w-100">
                    <h2 class="fw-bolder center">Login</h2>
                </div>
                <form action="{{route('loginaksi')}}" method="post" autocomplete="off" class="w-100">
                    @csrf
                    <div class="input-group mb-4 ">
                        <input type="text" name="username" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4"
                            placeholder="Username">
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" name="password" class="form-control form-control-lg bg-light fs-6 rounded-5 ps-4"
                            placeholder="Password">
                    </div>
                    <div class="input-group mb-3 justify-content-center">
                        <button class="btn btn-lg btn-primary w-50 fs-6 rounded-5">Login</button>
                    </div>
                </form>
                <div class="row">
                    <small>Don't have account? <a href="#">Sign Up</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection