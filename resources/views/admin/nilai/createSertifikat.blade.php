@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Konfirmasi Penerbitan Sertifikat untuk Siswa: {{ $siswa->nama }}</h1>

        <form action="{{ route('admin.sertifikat.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_kelas" value="{{ $kelas->id }}">
            <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">

            <div class="form-group">
                <label for="nilai_akhir">Nilai Akhir</label>
                <input type="number" name="nilai_akhir" id="nilai_akhir" class="form-control" value="{{ $nilai_akhir }}" readonly>
            </div>

            <button type="submit" class="btn btn-success mt-3">Terbitkan Sertifikat</button>
            <a href="{{ route('admin.sertifikat.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
@endsection
