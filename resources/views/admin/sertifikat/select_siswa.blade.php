@extends('layouts.admin')

@section('content')
    <div class="container">
                <h1>Tambah Penilaian</h1>

        <h5>Pilih Siswa untuk Nilai Kelas: {{ $kelas->nama_kelas }}</h5>

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
            <input type="hidden" name="step" value="inputNilai">
            <input type="hidden" name="id_kelas" value="{{ $kelas->id }}">

            <div class="form-group">
                <label for="siswa">Pilih Siswa</label>
                <select name="id_siswa" id="siswa" class="form-control" required>
                    @if($siswa->isEmpty())
                        <option value="">Tidak ada siswa yang belum dinilai</option>
                    @else
                        @foreach($siswa as $s)
                            <option value="{{ $s->id }}">{{ $s->nama }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3" {{ $siswa->isEmpty() ? 'disabled' : '' }}>Lanjutkan</button>
            <a href="{{ route('admin.nilai.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
@endsection
