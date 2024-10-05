@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Materi</h1>
            <div class="mb-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMateriModal">
                    Tambah Materi
                </button>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Materi
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Materi</th>
                                <th>Deskripsi</th>
                                <th>Kelas</th>
                                <th>Jenis Kelas</th> <!-- Tambahkan kolom untuk jenis_kelas -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materi as $m)
                                <tr>
                                    <td>{{ $m->nama_materi }}</td>
                                    <td>{{ $m->deskripsi }}</td>
                                    <td>{{ $m->kelas->nama_kelas }}</td>
                                    <td>{{ $m->kelas->jenis_kelas }}</td> <!-- Menampilkan jenis_kelas -->
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editMateriModal-{{ $m->id }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.materi.destroy', $m->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit Materi -->
                                <div class="modal fade" id="editMateriModal-{{ $m->id }}" tabindex="-1"
                                    aria-labelledby="editMateriModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editMateriModalLabel">Edit Materi
                                                    {{ $m->nama_materi }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.materi.update', $m->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="nama_materi">Nama Materi</label>
                                                        <input type="text" name="nama_materi" class="form-control"
                                                            id="nama_materi" value="{{ $m->nama_materi }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="deskripsi">Deskripsi</label>
                                                        <textarea name="deskripsi" class="form-control" id="deskripsi" required>{{ $m->deskripsi }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="id_kelas">Kelas</label>
                                                        <select name="id_kelas" id="id_kelas" class="form-control"
                                                            required>
                                                            @foreach ($kelas as $k)
                                                                <option value="{{ $k->id }}"
                                                                    {{ $k->id == $m->id_kelas ? 'selected' : '' }}>
                                                                    {{ $k->nama_kelas }} - {{ $k->jenis_kelas }}
                                                                    <!-- Tampilkan juga jenis_kelas di dropdown -->
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
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

    <!-- Modal Tambah Materi -->
    <div class="modal fade" id="addMateriModal" tabindex="-1" aria-labelledby="addMateriModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMateriModalLabel">Tambah Materi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.materi.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_kelas">Kelas</label>
                            <select name="id_kelas" class="form-control" id="id_kelas" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }} - {{ $k->jenis_kelas }}</option>
                                    <!-- Tampilkan juga jenis_kelas di pilihan tambah materi -->
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_materi">Nama Materi</label>
                            <input type="text" name="nama_materi" class="form-control" id="nama_materi" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" id="deskripsi" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
