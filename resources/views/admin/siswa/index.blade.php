@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Siswa</li>
            </ol>
            <div class="mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahSiswaModal">
                    Tambah Siswa
                </button>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Siswa
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                                <tr>
                                    <td>{{ $s->nama }}</td>
                                    <td>
                                        @if ($s->pendaftaranKelas->isNotEmpty())
                                            @foreach ($s->pendaftaranKelas as $pendaftaran)
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#detailJadwalModal-{{ $pendaftaran->id }}">
                                                    {{ $pendaftaran->jadwal->kelas->nama_kelas }} - Lihat Detail
                                                </button>
                                                <!-- Modal Detail Jadwal -->
                                            @endforeach
                                        @else
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#pilihKelasModal-{{ $s->id }}">
                                                Pilih Kelas dan Jadwal
                                            </button>
                                            <!-- Modal Pilih Kelas dan Jadwal -->
                                            @include('admin.siswa.pilihkelasdanjadwal')
                                        @endif
                                    </td>

                                    <td>
                                        @foreach ($s->pendaftaranKelas as $pendaftaran)
                                            @if ($pendaftaran->pembayaran->isNotEmpty())
                                                {{ $pendaftaran->pembayaran->first()->status }}
                                            @else
                                                Belum ada pembayaran
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <!-- Tombol Lihat Detail -->
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#detailSiswaModal-{{ $s->id }}">
                                            Lihat Detail
                                        </button>
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editSiswaModal-{{ $s->id }}">
                                            Edit
                                        </button>
                                    </td>
                                </tr>


                                <!-- Modal Detail Siswa -->

                                <!-- Modal Edit Siswa -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Tambah Siswa -->
    <div class="modal fade" id="tambahSiswaModal" tabindex="-1" aria-labelledby="tambahSiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahSiswaModalLabel">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.siswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Data Pribadi -->
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir:</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="kontak_hp">Kontak HP:</label>
                            <input type="text" name="kontak_hp" id="kontak_hp" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="pendidikan_terakhir">Pendidikan Terakhir:</label>
                            <input type="text" name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-control"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto Siswa:</label>
                            <input type="file" name="foto" id="foto" class="form-control" accept="image/*"
                                required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
