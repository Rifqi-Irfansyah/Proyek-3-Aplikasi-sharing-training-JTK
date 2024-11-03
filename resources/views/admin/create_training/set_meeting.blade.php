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

        // tanggal minimum (7 hari dari sekarang)
        function getMinDate() {
            const now = new Date(new Date().toLocaleString('en-US', { timeZone: 'Asia/Jakarta' }));
            const minDate = new Date(now);
            minDate.setDate(now.getDate() + 7);
            return minDate.toISOString().split('T')[0];
        }

        function formatDate(dateString) {
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            return new Date(dateString).toLocaleDateString('en-US', options);
        }

        // waktu minimum selesai
        function getMinEndTime(startTime) {
            const [hours, minutes] = startTime.split(':');
            const date = new Date();
            date.setHours(parseInt(hours));
            date.setMinutes(parseInt(minutes));
            date.setHours(date.getHours() + 1);
            return `${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}`;
        }

        for (let i = 0; i < {{ $jumlah_pertemuan }}; i++) {
            const dateInput = document.getElementById(`date_${i}`);
            const startTimeInput = document.getElementById(`waktu_mulai_${i}`);
            const endTimeInput = document.getElementById(`waktu_selesai_${i}`);

            // tanggal minimum untuk pertemuan pertama
            if (i === 0) {
                const minDate = getMinDate();
                dateInput.min = minDate;
                dateInput.title = `Minimum date: ${formatDate(minDate)}`;
            }

            startTimeInput.addEventListener('change', function() {
                const minEndTime = getMinEndTime(this.value);
                endTimeInput.min = minEndTime;
                // reset waktu selesai jika kurang dari minimum
                if (endTimeInput.value && endTimeInput.value < minEndTime) {
                    endTimeInput.value = minEndTime;
                }
            });

            dateInput.addEventListener('change', function() {
                if (i < {{ $jumlah_pertemuan }} - 1) {
                    const nextDateInput = document.getElementById(`date_${i + 1}`);
                    nextDateInput.min = this.value;
                    // reset nilai input berikutnya jika lebih kecil dari minimum
                    if (nextDateInput.value && nextDateInput.value < this.value) {
                        nextDateInput.value = '';
                    }
                }
            });
        }

        form.addEventListener('submit', function(event) {
            let valid = true;
            let errorMessage = '';

            // pertemuan pertama minimal 7 hari dari now
            const firstMeetingDate = document.getElementById('date_0');
            const minDate = getMinDate();

            if (firstMeetingDate.value < minDate) {
                valid = false;
                errorMessage = `The first meeting must be scheduled at least 7 days from now (${formatDate(minDate)}).\n`;
                firstMeetingDate.focus();
            }

            if (valid) {
                for (let i = 0; i < {{ $jumlah_pertemuan }}; i++) {
                    const dateInput = document.getElementById(`date_${i}`);
                    const startTimeInput = document.getElementById(`waktu_mulai_${i}`);
                    const endTimeInput = document.getElementById(`waktu_selesai_${i}`);

                    if (i > 0) {
                        const previousDate = new Date(document.getElementById(`date_${i-1}`).value);
                        const currentDate = new Date(dateInput.value);

                        if (currentDate <= previousDate) {
                            valid = false;
                            errorMessage += `The date for Meeting ${i + 1} must be after Meeting ${i}.\n`;
                            dateInput.focus();
                            break;
                        }
                    }
                    if (valid) {
                        // validasi waktu durasi minimal 1 jam
                        const startTime = new Date(`${dateInput.value} ${startTimeInput.value}:00`);
                        const endTime = new Date(`${dateInput.value} ${endTimeInput.value}:00`);
                        const durationInMinutes = (endTime - startTime) / (1000 * 60);

                        if (startTime >= endTime || durationInMinutes < 60) {
                            valid = false;
                            errorMessage += `Please check your start and finish time. Meeting ${i + 1} duration must be at least 1 hour.\n`;
                            endTimeInput.focus();
                            break;
                        }
                    }
                }
            }
            if (!valid) {
                event.preventDefault();

                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Date/Time',
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
