@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Pilih Siswa untuk Kelas: {{ $kelas->nama_kelas }}</h1>

        <form action="{{ route('admin.sertifikat.createSertifikat') }}" method="POST">
            @csrf
            <input type="hidden" name="id_kelas" value="{{ $kelas->id }}">

            <div class="form-group">
                <label for="siswa">Pilih Siswa</label>
                <select name="id_siswa" id="siswa" class="form-control">
                    @foreach($siswa as $s)
                        <option value="{{ $s->id }}">{{ $s->nama }} (Nilai Akhir: {{ $s->nilai->nilai_rata_rata }})</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Lanjutkan</button>
            <a href="{{ route('admin.sertifikat.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
@endsection
