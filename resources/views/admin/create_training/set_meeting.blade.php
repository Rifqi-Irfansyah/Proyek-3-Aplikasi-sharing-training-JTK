@extends('../layoutmaster')

@section('title', 'Atur Pertemuan')

@section('content')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false,
                customClass: {
                    popup: 'popup-success',
                    title: 'title',
                }
            });
        @endif
    });
</script>

@include('admin.topbar')
<div class="container d-flex justify-content-center align-items-center min-vh-100 mt-3 mb-5">
    <div class="row justify-content-center w-100">
        <div class="col-md-9">
            <div class="rounded-5 p-5 shadow box-area bg-white position-relative">
                <a href="{{ route('training.create') }}" class="btn btn-back rounded-circle position-absolute"
                   style="top: 20px; left: 20px; width: 35px; height: 35px; display: flex; justify-content: center; align-items: center;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="fw-bolder mb-4 text-center" style="font-size: 2em">Set Meetings Training</h1>
                <form action="{{ route('meeting.store') }}" method="POST" class="w-100" id="meetingForm">
                    @csrf
                    <input type="hidden" name="id_training" value="{{ $id_training }}">
                    @for ($i = 0; $i < $jumlah_pertemuan; $i++)
                        <h4>Meeting {{ $i + 1 }}</h4>

                        <div class="form-group mb-3">
                            <label for="topik_pertemuan_{{ $i }}" class="form-label">Meeting Discussion</label>
                            <input type="text" class="form-control rounded-5" id="topik_pertemuan_{{ $i }}" name="topik_pertemuan[]" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4 form-group mb-3">
                                <label for="date_{{ $i }}" class="form-label">Date</label>
                                <input type="date" class="form-control rounded-5" id="date_{{ $i }}" name="date[]" required>
                            </div>
                            <div class="col-4 form-group mb-3">
                                <label for="waktu_mulai_{{ $i }}" class="form-label">Start Time</label>
                                <input type="time" class="form-control rounded-5" id="waktu_mulai_{{ $i }}" name="waktu_mulai[]" required>
                            </div>
                            <div class="col-4 form-group mb-3">
                                <label for="waktu_selesai_{{ $i }}" class="form-label">Finish Time</label>
                                <input type="time" class="form-control rounded-5" id="waktu_selesai_{{ $i }}" name="waktu_selesai[]" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6 form-group mb-3">
                                <label for="status_{{ $i }}" class="form-label">Meeting Status</label>
                                <select class="form-control rounded-5" id="status_{{ $i }}" name="status[]" required>
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select>
                            </div>

                            <div class="col-6 form-group mb-3">
                                <label for="tempat_pelaksana_{{ $i }}" class="form-label">Location or Media</label>
                                <input type="text" class="form-control rounded-5" id="tempat_pelaksana_{{ $i }}" name="tempat_pelaksana[]" required>
                            </div>
                        </div>
                        <hr style="border: 2px solid #000; margin-top: 25px; margin-bottom: 25px;">
                    @endfor

                    <button type="submit" class="btn btn-lg w-100 fs-6 rounded-5 mt-3" style="background-color: #6cace4; color: white; transition: background-color 0.3s, transform 0.2s;" onmouseover="this.style.backgroundColor='#5aabbf'; this.style.transform='scale(1.05)';" onmouseout="this.style.backgroundColor='#6cace4'; this.style.transform='scale(1)';">
                        Set All Meetings
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('footer')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('meetingForm');
        form.addEventListener('submit', function(event) {
            let valid = true;
            let errorMessage = '';

            for (let i = 0; i < {{ $jumlah_pertemuan }}; i++) {
                const dateInput = document.getElementById(`date_${i}`);
                const startTimeInput = document.getElementById(`waktu_mulai_${i}`);
                const endTimeInput = document.getElementById(`waktu_selesai_${i}`);
                const startTime = new Date(`${dateInput.value} ${startTimeInput.value}:00`);
                const endTime = new Date(`${dateInput.value} ${endTimeInput.value}:00`);

                if (startTime >= endTime) {
                    valid = false;
                    errorMessage += `Please check the meeting time you set. The finish time for Meeting ${i + 1} must be greater than the start time.\n`;
                    startTimeInput.focus();
                    break;
                }

                // if (i > 0) {
                //     const previousDateInput = document.getElementById(`date_${i - 1}`);
                //     const previousDate = new Date(previousDateInput.value);

                //     if (previousDate >= new Date(dateInput.value)) {
                //         valid = false;
                //         errorMessage += `The date for Meeting ${i + 1} must be greater than the date for Meeting ${i}.\n`;
                //         dateInput.focus();
                //         break;
                //     }
                // }
            }

            if (!valid) {
                event.preventDefault();

                // Menampilkan SweetAlert dengan pesan error
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Time',
                    text: errorMessage,
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'popup-error',
                        confirmButton: 'btn-confirm',
                    }
                });
            }
        });
    });
</script>
@endsection
