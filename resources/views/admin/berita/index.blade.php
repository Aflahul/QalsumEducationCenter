@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Daftar Berita</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Berita</li>
            </ol>

            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahBeritaModal">Tambah Berita</button>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-newspaper"></i> Daftar Berita
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Konten</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berita as $b)
                                <tr>
                                    <td>{{ $b->judul }}</td>
                                    <td>{{ Str::limit($b->konten, 100) }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editBeritaModal-{{ $b->id }}">
                                            Edit
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteBeritaModal-{{ $b->id }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Edit Berita -->
                                <div class="modal fade" id="editBeritaModal-{{ $b->id }}" tabindex="-1" role="dialog" aria-labelledby="editBeritaModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Berita</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.berita.update', $b->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="judul">Judul</label>
                                                        <input type="text" name="judul" class="form-control" value="{{ $b->judul }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="konten">Konten</label>
                                                        <textarea name="konten" class="form-control" rows="4" required>{{ $b->konten }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Konfirmasi Hapus Berita -->
                                <div class="modal fade" id="deleteBeritaModal-{{ $b->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteBeritaModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus berita ini?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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

    <!-- Modal Tambah Berita -->
    <div class="modal fade" id="tambahBeritaModal" tabindex="-1" role="dialog" aria-labelledby="tambahBeritaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Berita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.berita.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="konten">Konten</label>
                            <textarea name="konten" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
