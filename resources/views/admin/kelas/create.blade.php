@extends('layouts.admin')

@section('content')
    <h2>Tambah Kelas Baru</h2>
    <form action="{{ route('admin.kelas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Kelas</label>
            <input type="text" name="nama" class="form-control">
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
