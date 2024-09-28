@extends('layouts.guest')
@section('title', 'Pendaftaran')
@section('content')
    <div class="container pb-6">
        <h2 class="text-center my-4">Pendaftaran</h2>
        <div class="row">
            @foreach ($kelas as $k)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            {{ $k->nama_kelas }}
                        </div>
                        <div class="card-body">
                            <h5>Jadwal:</h5>
                            @foreach ($k->jadwal as $j)
                                <div class="card shadow mb-4 jadwal-card" id="jadwal-card-{{ $j->id }}">
                                    <div class="card-body bg-gradient-white">
                                        <strong>{{ $j->nama_jadwal }}</strong>
                                        <p>Hari: {{ $j->hari }}<br>
                                            Jam: {{ $j->jam_mulai }} - {{ $j->jam_selesai }}</p>
                                        <p>Materi:
                                            @foreach ($k->materi as $m)
                                                <span class="badge bg-secondary">{{ $m->nama_materi }}</span>
                                            @endforeach
                                        </p>
                                        <button class="btn btn-sm btn-info select-jadwal" data-jadwal="{{ $j->id }}">
                                            Pilih Jadwal
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger cancel-jadwal"
                                            data-jadwal="{{ $j->id }}">
                                            Batalkan Pilihan
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Formulir Pendaftaran -->
        <div class="card py-4 shadow-xl ">
            <div class="row py-5">
                <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
                    <h3 class="text-center">Formulir Pendaftaran</h3>
                    <form role="form" id="form-pendaftaran" method="post" action="{{ route('pendaftaran.submit') }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body ">
                            <!-- Nomor Siswa -->
                            {{-- <div class="mb-4">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label">Nomor Siswa (Otomatis)</label>
                                <input name="nomor_siswa" type="text" class="form-control"
                                    value="{{ old('nomor_siswa', $nomor_siswa_terakhir ?? '') }}" readonly>
                            </div>
                        </div> --}}

                            <!-- Nama Lengkap -->
                            <div class="mb-4">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input name="nama" type="text" class="form-control" placeholder="" required>
                                </div>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="mb-4">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input name="tanggal_lahir" type="date" class="form-control" required>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="mb-4">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Alamat</label>
                                    <input name="alamat" type="text" class="form-control" placeholder="" required>
                                </div>
                            </div>

                            <!-- Kontak HP -->
                            <div class="mb-4">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Kontak HP</label>
                                    <input name="kontak_hp" type="text" class="form-control" placeholder="" required>
                                </div>
                            </div>

                            <!-- Pendidikan Terakhir -->
                            <div class="mb-4">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Pendidikan Terakhir</label>
                                    <input name="pendidikan_terakhir" type="text" class="form-control" placeholder=""
                                        required>
                                </div>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="mb-4">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label"></label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Foto -->
                            <div class="mb-4">
                                <div class="input-group input-group-static">
                                    <label>Unggah Foto</label>
                                    <input name="foto" type="file" class="form-control" accept="image/*" required>
                                </div>
                            </div>

                            <!-- Hidden Input untuk ID Jadwal yang Dipilih -->
                            <input type="hidden" name="id_jadwal" id="selectedJadwalId" required>

                            <!-- Syarat dan Ketentuan -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check form-switch mb-4 d-flex align-items-center">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                            required>
                                        <label class="form-check-label ms-3 mb-0" for="flexSwitchCheckDefault">Saya setuju
                                            dengan <a href="javascript:;" class="text-dark" data-bs-toggle="modal"
                                                data-bs-target="#syaratKetentuanModal"><u>Syarat dan
                                                    Ketentuan</u></a>.</label>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn bg-gradient-dark w-100">Daftar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <style>
        /* Kelas untuk outline hijau pada card yang dipilih */
        .selected-jadwal {
            border: 2px solid #28a745;
            /* Warna hijau seperti btn-outline-success */
            background-color: rgba(0, 128, 0, 0.1);
            /* Background hijau sedikit gelap */
            transition: all 0.3s ease-in-out;
        }
    </style>

    <script>
        // Script untuk memilih jadwal dan mengisi hidden input pada form
        document.querySelectorAll('.select-jadwal').forEach(function(button) {
            button.addEventListener('click', function() {
                var jadwalId = this.getAttribute('data-jadwal');
                // Set hidden input dengan ID jadwal yang dipilih
                document.getElementById('selectedJadwalId').value = jadwalId;

                // Hapus kelas 'selected-jadwal' dari semua card
                document.querySelectorAll('.jadwal-card').forEach(function(card) {
                    card.classList.remove('selected-jadwal');
                });

                // Tambahkan kelas 'selected-jadwal' ke card yang dipilih untuk memberikan outline hijau
                document.getElementById('jadwal-card-' + jadwalId).classList.add('selected-jadwal');

                // Pesan notifikasi
                alert('Jadwal telah dipilih. Silakan lengkapi formulir data diri.');
            });
        });

        // Script untuk membatalkan pilihan jadwal
        document.querySelectorAll('.cancel-jadwal').forEach(function(button) {
            button.addEventListener('click', function() {
                var jadwalId = this.getAttribute('data-jadwal');
                // Hapus kelas 'selected-jadwal' dari card yang dipilih
                document.getElementById('jadwal-card-' + jadwalId).classList.remove('selected-jadwal');

                // Kosongkan nilai hidden input
                document.getElementById('selectedJadwalId').value = '';

                // Pesan notifikasi
                alert('Pilihan jadwal telah dibatalkan.');
            });
        });
    </script>
@endsection
