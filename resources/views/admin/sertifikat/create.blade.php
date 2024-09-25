@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Tambah Penilaian</h1>
        
        <h5>Pemilihan Kelas</h5>
        
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
            <input type="hidden" name="step" value="selectKelas">
            
            <div class="form-group">
                <label for="kelas">Pilih Kelas</label>
                <select name="id_kelas" id="kelas" class="form-control" required>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Lanjutkan</button>
            <a href="{{ route('admin.nilai.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
@endsection
