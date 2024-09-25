@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Pilih Kelas</h1>

        <form action="{{ route('admin.sertifikat.selectKelas') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kelas">Pilih Kelas</label>
                <select name="id_kelas" id="kelas" class="form-control">
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Lanjutkan</button>
            <a href="{{ route('admin.sertifikat.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
@endsection
