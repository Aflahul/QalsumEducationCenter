@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Siswa</li>
            </ol>
            <div class="mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSiswaModal">
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
                                <th>Nomor Induk</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jenis Kelas</th>
                                <th>Masuk</th>
                                <th>Progres Kelas</th>
                                <th>Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nomor Induk</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jenis Kelas</th>
                                <th>Masuk</th>
                                <th>Progres Kelas</th>
                                <th>Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($siswa as $s)
                                <tr>
                                    <td>{{ $s->nomor_siswa }}</td>
                                    <td>{{ $s->nama }}</td>


                                    <td>{{ $s->jadwal->kelas->nama_kelas }}</td>

                                    <td>{{ $s->jadwal->kelas->jenis_kelas }}</td>

                                    <td>{{ $s->created_at }}</td>


                                    <td>
                                        @foreach ($s->nilai as $nilai)
                                            <!-- Cek apakah grade sudah ada -->
                                            @if (is_null($nilai->grade))
                                                <span class="btn btn-info btn-sm">Berjalan</span>
                                            @else
                                                <span class="btn btn-success btn-sm">Selesai</span>
                                            @endif
                                        @endforeach
                                    </td>


                                    <td>

                                        @foreach ($s->pembayaran as $item)
                                            @if ($item->status === 'Belum Lunas')
                                                <p class="btn btn-warning btn-sm">{{ $item->status }}</p>
                                            @else
                                                <p class="btn btn-info btn-sm">{{ $item->status }}</p>
                                            @endif
                                        @endforeach
                                        <!-- Status bisa ditentukan berdasarkan kondisi tertentu -->
                                    </td>
                                    <td>
                                        <!-- Tombol Lihat Detail -->
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#detailSiswaModal-{{ $s->id }}">
                                            Detail
                                        </button>
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editSiswaModal-{{ $s->id }}">
                                            Edit
                                        </button>
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('admin.siswa.destroy', $s->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Modal Detail Siswa -->
                                <div class="modal fade" id="detailSiswaModal-{{ $s->id }}" tabindex="-1"
                                    aria-labelledby="detailSiswaModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailSiswaModalLabel">Detail Siswa</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4 text-center">
                                                        <img src="{{ asset($s->foto) }}" alt="Foto Siswa"
                                                            class="img-fluid rounded-circle mb-3"
                                                            style="max-height: 200px;">
                                                        <h4>{{ $s->nama }}</h4>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="mb-2">
                                                            <strong>Nomor Induk:</strong> {{ $s->nomor_siswa }}
                                                        </div>
                                                        <div class="mb-2">
                                                            <strong>Tanggal Lahir:</strong>
                                                            {{ \Carbon\Carbon::parse($s->tanggal_lahir)->format('d-m-Y') }}
                                                        </div>
                                                        <div class="mb-2">
                                                            <strong>Kontak HP:</strong> {{ $s->kontak_hp }}
                                                        </div>
                                                        <div class="mb-2">
                                                            <strong>Jenis Kelamin:</strong> {{ $s->jenis_kelamin }}
                                                        </div>
                                                        <div class="mb-2">
                                                            <strong>Pendidikan Terakhir:</strong>
                                                            {{ $s->pendidikan_terakhir }}
                                                        </div>
                                                        <div class="mb-2">
                                                            <strong>Alamat:</strong> {{ $s->alamat }}
                                                        </div>
                                                        <div class="mb-2">
                                                            <strong>Kelas dan Jadwal:</strong><br>
                                                            <li>
                                                                {{ optional($s->jadwal)->kelas->nama_kelas ?? 'Kelas tidak tersedia' }}
                                                                |
                                                                {{ optional($s->jadwal)->hari }}
                                                                {{ optional($s->jadwal)->jam_mulai }} -
                                                                {{ optional($s->jadwal)->jam_selesai }}
                                                            </li>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal Edit Siswa -->
                                <div class="modal fade" id="editSiswaModal-{{ $s->id }}" tabindex="-1"
                                    aria-labelledby="editSiswaModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editSiswaModalLabel">Edit Siswa</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="
                                                {{ route('admin.pegawai.update', $s->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="nama">Nama</label>
                                                                <input type="text" name="nama" class="form-control"
                                                                    id="nama" value="{{ $s->nama }}" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                                <input type="date" name="tanggal_lahir"
                                                                    class="form-control" id="tanggal_lahir"
                                                                    value="{{ $s->tanggal_lahir }}" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="kontak_hp">Kontak HP</label>
                                                                <input type="text" name="kontak_hp"
                                                                    class="form-control" id="kontak_hp"
                                                                    value="{{ $s->kontak_hp }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                                <select name="jenis_kelamin" class="form-control"
                                                                    id="jenis_kelamin" required>
                                                                    <option value="Laki-laki"
                                                                        {{ $s->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                                                        Laki-laki</option>
                                                                    <option value="Perempuan"
                                                                        {{ $s->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                                        Perempuan</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="foto">Foto</label>
                                                                <input type="file" name="foto" class="form-control"
                                                                    id="foto">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="pendidikan_terakhir">Pendidikan
                                                                    Terakhir</label>
                                                                <select name="pendidikan_terakhir" class="form-control"
                                                                    id="pendidikan_terakhir" required>
                                                                    <option value="SD"
                                                                        {{ $s->pendidikan_terakhir == 'SD' ? 'selected' : '' }}>
                                                                        SD</option>
                                                                    <option value="SMP"
                                                                        {{ $s->pendidikan_terakhir == 'SMP' ? 'selected' : '' }}>
                                                                        SMP</option>
                                                                    <option value="SMA"
                                                                        {{ $s->pendidikan_terakhir == 'SMA' ? 'selected' : '' }}>
                                                                        SMA</option>
                                                                    <option value="D1"
                                                                        {{ $s->pendidikan_terakhir == 'D1' ? 'selected' : '' }}>
                                                                        D1</option>
                                                                    <option value="D2"
                                                                        {{ $s->pendidikan_terakhir == 'D2' ? 'selected' : '' }}>
                                                                        D2</option>
                                                                    <option value="D3"
                                                                        {{ $s->pendidikan_terakhir == 'D3' ? 'selected' : '' }}>
                                                                        D3</option>
                                                                    <option value="D4"
                                                                        {{ $s->pendidikan_terakhir == 'D4' ? 'selected' : '' }}>
                                                                        D4</option>
                                                                    <option value="S1"
                                                                        {{ $s->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>
                                                                        S1</option>
                                                                    <option value="S2"
                                                                        {{ $s->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>
                                                                        S2</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="alamat">Alamat</label>
                                                        <textarea name="alamat" class="form-control" id="alamat" required>{{ $s->alamat }}</textarea>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="id_jadwal">Kelas dan Jadwal</label>
                                                        <select name="id_jadwal" class="form-control" id="id_jadwal"
                                                            required>
                                                            <option value="" disabled>Pilih Kelas dan Jadwal</option>
                                                            @foreach ($jadwal as $j)
                                                                <option value="{{ $j->id }}"
                                                                    {{ $s->id_jadwal == $j->id ? 'selected' : '' }}>
                                                                    {{ optional($j->kelas)->nama_kelas ?? 'Kelas tidak tersedia' }}
                                                                    |
                                                                    {{ $j->hari }}
                                                                    {{ $j->jam_mulai }}-{{ $j->jam_selesai }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Simpan
                                                        Perubahan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Tambah Siswa -->
    <div class="modal fade" id="addSiswaModal" tabindex="-1" aria-labelledby="addSiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSiswaModalLabel">Tambah Siswa Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form action="{{ route('admin.siswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama"
                                        placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                        required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kontak_hp">Kontak HP</label>
                                    <input type="text" name="kontak_hp" class="form-control" id="kontak_hp"
                                        placeholder="Masukkan nomor HP" required>
                                </div>

                            </div>
                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="foto">Foto</label>
                                    <input type="file" name="foto" class="form-control" id="foto">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pendidikan_terakhir">Pendidikan
                                        Terakhir</label>
                                    <select name="pendidikan_terakhir" class="form-control" id="pendidikan_terakhir"
                                        required>
                                        <option value="" disabled selected>Pilih
                                            Pendidikan Terakhir</option>
                                        <option value="SD">
                                            SD</option>
                                        <option value="SMP">
                                            SMP</option>
                                        <option value="SMA">
                                            SMA</option>
                                        <option value="D1">
                                            D1</option>
                                        <option value="D2">
                                            D2</option>
                                        <option value="D3">
                                            D3</option>
                                        <option value="D4">
                                            D4</option>
                                        <option value="S1">
                                            S1</option>
                                        <option value="S2">
                                            S2</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" id="alamat" placeholder="Masukkan alamat lengkap" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="id_jadwal">Kelas dan Jadwal</label>
                            <select name="id_jadwal" class="form-control" id="id_jadwal" required>
                                <option value="" disabled selected>Pilih Kelas dan Jadwal</option>

                                @foreach ($jadwal as $j)
                                    <option value="{{ $j->id }}">
                                        {{ optional($j->kelas)->nama_kelas ?? 'Kelas tidak tersedia' }} |
                                        {{ $j->hari }} {{ $j->jam_mulai }}-{{ $j->jam_selesai }}</option>
                                @endforeach

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
