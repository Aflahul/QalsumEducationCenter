@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 ">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3>Profil Lembaga</h3>
                </div>

                <div class="card-body">
                    <!-- Flash Message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Tampilkan Profil Lembaga -->
                    <div class="row">
                        <div class="col-md-3">
                            @if ($profil->logo)
                                <img src="{{ asset($profil->logo) }}" alt="Logo Lembaga" class="img-fluid rounded  p-4 ">
                            @else
                                <img src="{{ asset('img/qec.png') }}" alt="Logo Default" class="img-fluid rounded p-4">
                            @endif
                        </div>
                        <div class="col-md-9">
                            <h4 class="mb-2">{{ $profil->nama_lembaga }}</h4>
                            <p><strong>Alamat:</strong> {{ $profil->alamat }}</p>
                            <p><strong>Email:</strong> {{ $profil->email }}</p>
                            <p><strong>Telepon:</strong> {{ $profil->telepon }}</p>
                            <p><strong>Deskripsi:</strong> {!! nl2br(e($profil->deskripsi)) !!}</p>
                        </div>
                    </div>

                    <!-- Tombol Edit Profil -->
                    <div class="mt-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfilModal">
                            Edit Profil
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfilModalLabel">Edit Profil Lembaga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.profil.update', $profil->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_lembaga" class="form-label">Nama Lembaga</label>
                        <input type="text" class="form-control" id="nama_lembaga" name="nama_lembaga" value="{{ $profil->nama_lembaga }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" required>{{ $profil->alamat }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $profil->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $profil->telepon }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ $profil->deskripsi }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo Lembaga</label>
                        <input type="file" class="form-control" id="logo" name="logo">
                        @if ($profil->logo)
                            <small class="text-muted">Logo saat ini: {{ $profil->logo }}</small>
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
