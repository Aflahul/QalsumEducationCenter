@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pegawai | Instruktur</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Pegawai | Instruktur</li>
            </ol>
            <div class="mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPegawaiModal">
                    Tambah Instruktur
                </button>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Instruktur
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Kontak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Kontak</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($pegawai as $p)
                                <tr>
                                    <td>{{ $p->nama }}</td>
                                    <td>Kelas id -> nama kelas</td>
                                    <td>{{ $p->kontak_hp }}</td>
                                    <td>
                                        <!-- Tombol Lihat Detail -->
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#detailPegawaiModal-{{ $p->id }}">
                                            Lihat Detail
                                        </button>
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editPegawaiModal-{{ $p->id }}">
                                            Edit
                                        </button>
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('admin.instruktur.destroy', $p->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pegawai ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Modal Detail Pegawai -->
                                <div class="modal fade" id="detailPegawaiModal-{{ $p->id }}" tabindex="-1"
                                    aria-labelledby="detailPegawaiModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailPegawaiModalLabel">Detail Instruktur</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset($p->foto) }}" alt="Foto Pegawai" class="img-fluid">
                                                <p><strong>Nama:</strong> {{ $p->nama }}</p>
                                                {{-- <p><strong>Jabatan:</strong> {{ $p->jabatan }}</p> --}}
                                                <p>Nama Kelas yg di ampuh</p>
                                                <p><strong>Tanggal Lahir:</strong> {{ $p->tanggal_lahir }}</p>
                                                <p><strong>Alamat:</strong> {{ $p->alamat }}</p>
                                                <p><strong>Kontak:</strong> {{ $p->kontak_hp }}</p>
                                                <p><strong>Pendidikan Terakhir:</strong> {{ $p->pendidikan_terakhir }}
                                                </p>
                                                <p><strong>Jenis Kelamin:</strong> {{ $p->jenis_kelamin }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Edit Pegawai -->
                                <div class="modal fade" id="editPegawaiModal-{{ $p->id }}" tabindex="-1"
                                    aria-labelledby="editPegawaiModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editPegawaiModalLabel">Edit Instruktur</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.instruktur.update', $p->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="username">Username</label>
                                                        <input type="text" name="username" class="form-control"
                                                            id="username" value="{{ $p->username }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama">Nama</label>
                                                        <input type="text" name="nama" class="form-control"
                                                            id="nama" value="{{ $p->nama }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                                        <input type="date" name="tanggal_lahir" class="form-control"
                                                            id="tanggal_lahir" value="{{ $p->tanggal_lahir }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat">Alamat</label>
                                                        <textarea name="alamat" class="form-control" id="alamat" required>{{ $p->alamat }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kontak_hp">Kontak HP</label>
                                                        <input type="text" name="kontak_hp" class="form-control"
                                                            id="kontak_hp" value="{{ $p->kontak_hp }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                                        <input type="text" name="pendidikan_terakhir"
                                                            class="form-control" id="pendidikan_terakhir"
                                                            value="{{ $p->pendidikan_terakhir }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                                        <select name="jenis_kelamin" class="form-control"
                                                            id="jenis_kelamin" required>
                                                            <option value="Laki-laki"
                                                                {{ $p->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                                                Laki-laki</option>
                                                            <option
                                                                value="Perempuan"{{ $p->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                                Perempuan</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jabatan">Kelas</label>
                                                        <select name="kelas" class="form-control" id="kelas"
                                                            required>
                                                            <option value="TIK A"> TIK A</option>
                                                            <option value="TIK B"> TIK B</option>
                                                            {{-- <option value="resepsionis" {{ $p->jabatan == 'resepsionis' ? 'selected' : '' }}>Resepsionis</option> --}}

                                                        </select>
                                                    </div>
                                                    <!-- Input hidden untuk jabatan -->
                                                    <input type="hidden" name="jabatan" value="instruktur">

                                                    <div class="form-group">
                                                        <label for="foto">Foto</label>
                                                        <input type="file" name="foto" class="form-control-file"
                                                            id="foto" accept="image/*">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
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

    <!-- Modal Tambah Pegawai -->
    <div class="modal fade" id="addPegawaiModal" tabindex="-1" aria-labelledby="addPegawaiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPegawaiModalLabel">Tambah Instruktur Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.instruktur.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username"
                                        placeholder="Masukkan username" required>
                                </div>
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
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
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
                                    <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                    <input type="text" name="pendidikan_terakhir" class="form-control"
                                        id="pendidikan_terakhir" placeholder="Masukkan pendidikan terakhir" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kelas">Kelas</label>
                                    <select name="kelas" class="form-control" id="kelas" required>
                                        <option value="TIK A">TIK A</option>
                                        <option value="TIK B">TIK B</option>

                                    </select>
                                    <!-- Input hidden untuk jabatan -->
                                    <input type="hidden" name="jabatan" value="instruktur">

                                </div>
                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" class="form-control" id="alamat" placeholder="Masukkan alamat lengkap" rows="3"
                                        required></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="foto">Foto</label>
                                    <input type="file" name="foto" class="form-control-file" id="foto">
                                </div>
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
    </div>
    @include('admin.instruktur.modal')
@endsection