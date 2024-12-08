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
                <th class="text-center">Email User</th>
                <th class="text-center">Date Submitted</th>
            </tr>
        </thead>
        <tbody>
            @if($usulans->isEmpty())
            <tr>
                <td colspan="5" class="text-center text-dark p-5" ><i>No suggestions yet.</i></td>
            </tr>
            @else
                @foreach($usulans as $usulan)
                <tr>
                    <td class="text-center">{{ $usulan->judul_materi }}</td>
                    <td class="text-center">{{ $usulan->bahasan }}</td>
                    <td class="text-center">{{ $usulan->email_pengusul }}</td>
                    <td class="text-center">{{ Carbon\Carbon::parse($usulan->created_at)->timezone('Asia/Jakarta')->format('l, d M Y - H:i:s') }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@include('footer')
</div>

@endsection
