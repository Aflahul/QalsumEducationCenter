@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Tambah Penilaian</h1>

        <h4>Input Nilai untuk Siswa: {{ $siswa->nama }} - Kelas: {{ $kelas->nama_kelas }}</h4>

        {{-- Menampilkan error jika ada --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.nilai.store') }}" method="POST">
            @csrf
            <input type="hidden" name="step" value="saveNilai">
            <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
            <input type="hidden" name="id_kelas" value="{{ $kelas->id }}">
            <input type="hidden" name="id_jadwal" value="{{ $siswa->id_jadwal }}">

            @foreach($materi as $m)
                <div class="form-group">
                    <label for="nilai">{{ $m->nama_materi }}</label>
                    <input type="number" name="nilai[{{ $m->id }}]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="catatan">Catatan</label>
                    <textarea name="catatan[{{ $m->id }}]" class="form-control"></textarea>
                </div>
            @endforeach

            <button type="submit" class="btn btn-success mt-3">Simpan Penilaian</button>
            <a href="{{ route('admin.nilai.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
@endsection
