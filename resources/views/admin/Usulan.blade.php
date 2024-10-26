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
    <h1>Usulan yang Diterima</h1>
    <br>
    <table class="table table-default table-hover" style="border-radius: 10px; overflow: hidden;">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Judul Materi</th>
                <th>Bahasan</th>
                <th>Email Pengusul</th>
                <th>Usulan</th>
                <th>Status</th>
                <th>Dibuat pada</th>
                {{-- <th>Aksi</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($usulans as $usulan)
            <tr>
                <td>{{ $usulan->id_usulan }}</td>
                <td>{{ $usulan->judul_materi }}</td>
                <td>{{ $usulan->bahasan }}</td>
                <td>{{ $usulan->email_pengusul }}</td>
                <td>{{ $usulan->usulan }}</td>
                <td>{{ $usulan->status }}</td>
                <td>{{ $usulan->created_at }}</td>
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
