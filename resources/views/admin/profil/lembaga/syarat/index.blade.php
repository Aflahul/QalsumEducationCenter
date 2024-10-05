@extends('layouts.admin')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Syarat dan Ketentuan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Syarat dan Ketentuan</li>
        </ol>

        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahGaleriModal">Tambah Gambar</button>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-images"></i> Daftar Galeri
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Syarat dan Ketentuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($syarat as $g)
                            <tr>
                                <td></td>
                                <td>{{ $g->konten }}</td>                                
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editGaleriModal-{{ $g->id }}">
                                        Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteGaleriModal-{{ $g->id }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Edit Galeri -->
                            <div class="modal fade" id="editGaleriModal-{{ $g->id }}" tabindex="-1" role="dialog" aria-labelledby="editGaleriModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Syarat dan Ketentuan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.syarat.update', $g->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="konten">Judul</label>
                                                    <input type="text" name="konten" class="form-control" value="{{ $g->konten }}" required>
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

                            <!-- Modal Konfirmasi Hapus Galeri -->
                            <div class="modal fade" id="deleteGaleriModal-{{ $g->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteGaleriModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus konten ini?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin.galeri.destroy', $g->id) }}" method="POST">
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

<!-- Modal Tambah Galeri -->
<div class="modal fade" id="tambahGaleriModal" tabindex="-1" role="dialog" aria-labelledby="tambahGaleriModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Syarat dan Ketentuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="konten">Syarat dan Ketentuan</label>
                        <input type="text" name="konten" class="form-control" required>
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
