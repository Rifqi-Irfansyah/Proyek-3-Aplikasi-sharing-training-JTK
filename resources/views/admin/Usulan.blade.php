<!-- resources/views/admin/usulan/index.blade.php -->
@extends ('../layoutmaster')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@section('title', 'Usulan Peserta')



@section('content')

<div class="d-flex flex-column min-vh-100">
  @include('admin.topbar')
  <div class="container">
    <br>
    <h1>Suggestion From User</h1>
    <br>
    <table class="table table-default table-hover" style="border-radius: 10px; overflow: hidden;">
        <thead class="table-primary">
            <tr>
                <th class="text-center">Training Name</th>
                <th class="text-center">Disscusion</th>
                <th class="text-center">Suggestion</th>
                <th class="text-center">Email User</th>
                <th class="text-center">Date Submitted</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usulans as $usulan)
            <tr>
                <td class="text-center">{{ $usulan->judul_materi }}</td>
                <td class="text-center">{{ $usulan->bahasan }}</td>
                <td class="text-center">{{ $usulan->usulan }}</td>
                <td class="text-center">{{ $usulan->email_pengusul }}</td>
                <td class="text-center">{{ Carbon\Carbon::parse($usulan->created_at)->timezone('Asia/Jakarta')->format('l, d M Y - H:i:s') }}</td>

                {{-- <td>
                    <form action="{{ route('usulan.update', $usulan->id_usulan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="Dilihat" {{ $usulan->status == 'Dilihat' ? 'selected' : '' }}>Dilihat</option>
                            <option value="Belum dilihat" {{ $usulan->status == 'Belum dilihat' ? 'selected' : '' }}>Belum dilihat</option>
                        </select>
                    </form>
                </td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('footer')
</div>

@endsection
