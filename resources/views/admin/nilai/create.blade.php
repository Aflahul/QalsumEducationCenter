@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Penilaian Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.nilai.index') }}">Penilaian Siswa</a></li>
                <li class="breadcrumb-item active">Tambah Penilaian</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-plus me-1"></i>
                    Form Tambah Penilaian
                </div>
                <div class="card-body">
                    @if ($siswa->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            Semua siswa sudah dinilai. Tidak ada siswa yang dapat ditambahkan penilaiannya.
                        </div>
                    @else
                        <form action="{{ route('admin.nilai.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="siswa_id" class="form-label">Pilih Siswa</label>
                                <select id="siswa_id" name="siswa_id" class="form-select" required>
                                    <option value="">-- Pilih Siswa --</option>
                                    @foreach ($siswa as $s)
                                        <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->nomor_siswa }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <hr>

                            <h5>Nilai</h5>
                            @foreach ($materi as $m)
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nilai[{{ $m->id }}]" class="form-label">{{ $m->nama_materi }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" id="nilai[{{ $m->id }}]" name="nilai[{{ $m->id }}]"
                                            class="form-control" placeholder="Masukkan nilai" required>
                                    </div>
                                </div>
                            @endforeach

                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea id="catatan" name="catatan" class="form-control" rows="3" placeholder="Catatan (opsional)"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan Penilaian</button>
                                <a href="{{ route('admin.nilai.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
