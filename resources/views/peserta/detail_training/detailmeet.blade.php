@extends('peserta.detail_training.sidebar')

@section('aboutSelect', 'hovered')
@section('isi')

    <div class="content ms-300 vh-auto w-100" style="background-color: #9BBBF2;">

        <div class="row mt-5">
            <div class="col-8 offset-2 text-center">
                <h1 style="font-weight: 700">Detail Meet - {{ $training->judul_training }}</h1>
            </div>
        </div>

        <div class="container bg-white p-5 rounded-5 shadow ps-1 pt-1 mt-5 ms-5" style="margin-left: 40px;">

            <div class="row mt-5 justify-content-center">
                <div class="col-3"><i class="fa-regular fa-clock me-3"></i>Start Meet</div>
                <div class="col-7">{{ $meet->waktu_mulai }}</div>
            </div>

            <div class="row mt-4 justify-content-center">
                <div class="col-3"><i class="fa-regular fa-clock me-3"></i>Finish Meet</div>
                <div class="col-7">{{ $meet->waktu_selesai }}</div>
            </div>

            <div class="row mt-4 justify-content-center">
                <div class="col-3"><i class="fa-solid fa-bars-progress me-3"></i>Status</div>
                <div class="col-7">{{ $meet->status }}</div>
            </div>

            <div class="row mt-4 justify-content-center">
                <div class="col-3"><i class="fa-solid fa-link me-3"></i>Room/Link</div>
                <div class="col-7">
                    @if ($meet->status === 'online')
                        @php
                            $url = $meet->tempat_pelaksana;
                            if (!preg_match('~^(?:f|ht)tps?://~i', $url)) {
                                $url = "https://{$url}";
                            }
                        @endphp
                        <a href="{{ $url }}" target="_blank">{{ $meet->tempat_pelaksana }}</a>
                    @else
                        {{ $meet->tempat_pelaksana }}
                    @endif
                </div>
            </div>

            <div class="row mt-4 justify-content-center">
                <div class="col-3"><i class="fa-solid fa-chalkboard me-3"></i>Topic</div>
                <div class="col-7">{{ $meet->topik_pertemuan }}</div>
            </div>

            <div class="row mt-4 justify-content-center">
                <div class="col-3"><i class="fa-solid fa-user-check me-3"></i>Attendance</div>
                <div class="col-7">
                    <button id="attendanceButton" class="btn btn-dark btn-sm rounded-4 px-3">Click Here</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const waktuMulai = new Date("{{ $meet->waktu_mulai }}");
            const waktuSelesai = new Date("{{ $meet->waktu_selesai }}");
            const trainerMemulai = "{{ $meet->pertemuan_mulai }}" ? new Date("{{ $meet->pertemuan_mulai }}") : null;
            const trainerSelesai = "{{ $meet->pertemuan_selesai }}" ? new Date("{{ $meet->pertemuan_selesai }}") : null;

            const attendanceButton = document.getElementById('attendanceButton');
            let absent = false;

            function getCurrentTime() {
                return new Date().toLocaleString("en-US", {
                    timeZone: "Asia/Jakarta"
                });
            }

            function updateButtonStatus() {
                const now = new Date(getCurrentTime());

                if (absent === false) {
                    if (now < waktuMulai) {
                        attendanceButton.classList.add('btn-dark');
                        attendanceButton.onclick = function() {
                            showAlertWarning('Warning', 'Cannot take attendance, has not yet entered the meeting time');
                        };
                    } else if (now >= waktuMulai && now <= waktuSelesai && trainerMemulai === null) {
                        attendanceButton.classList.add('btn-warning');
                        attendanceButton.onclick = function() {
                            showAlertWarning('Warning', 'Cannot take attendance, the trainer has not opened absence.');
                        };
                    } else if (now >= waktuMulai && now <= waktuSelesai && trainerMemulai !== null) {
                        absent = true;
                        attendanceButton.classList.remove('btn-dark', 'btn-warning', 'btn-danger');
                        attendanceButton.classList.add('btn-success');
                        attendanceButton.onclick = function() {
                            // AJAX request
                            fetch('{{ route('attendancePeserta') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    },
                                    body: JSON.stringify({
                                        id_jadwal: '{{ $meet->id_jadwal }}',
                                        email: '{{ auth()->user()->email }}'
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        showAlertSuccess('Success', data.message);
                                    } else {
                                        showAlertError('Failed', data.message);
                                    }
                                })
                                .catch(error => {
                                    showAlertError('Error', 'There was an error processing your request.');
                                });
                        };
                    } else if (now > trainerSelesai && trainerSelesai !== null) {
                        attendanceButton.classList.add('btn-danger');
                        attendanceButton.onclick = function() {
                            showAlertError('Failed', 'Cannot take attendance, the trainer has closed the meeting.');
                        };
                    } else {
                        attendanceButton.classList.add('btn-danger');
                        attendanceButton.onclick = function() {
                            showAlertError('Failed', 'Cannot take attendance, the meeting time has passed!');
                        };
                    }
                }
            }

            setInterval(updateButtonStatus, 1000);
        });

        function showAlertError(title, message) {
            Swal.fire({
                icon: 'error',
                title: title,
                text: message,
                timer: 2000,
                showConfirmButton: false,
                customClass: {
                    popup: 'popup-error',
                    title: 'title',
                }
            });
        }

        function showAlertWarning(title, message) {
            Swal.fire({
                icon: 'warning',
                title: title,
                text: message,
                timer: 2000,
                showConfirmButton: false,
                customClass: {
                    popup: 'popup-warning',
                    title: 'title',
                }
            });
        }

        function showAlertSuccess(title, message) {
            Swal.fire({
                icon: 'success',
                title: title,
                text: message,
                timer: 2000,
                showConfirmButton: false,
                customClass: {
                    popup: 'popup-success',
                    title: 'title',
                }
            });
        }
    </script>
@endsection
