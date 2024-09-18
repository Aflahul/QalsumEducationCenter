@extends('layouts.admin')

@section('content')
    <h2>Edit Jadwal</h2>
    <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="kelas">Kelas</label>
            <select name="kelas_id" class="form-control">
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ $k->id == $jadwal->kelas_id ? 'selected' : '' }}>{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="waktu">Waktu</label>
            <input type="text" name="waktu" class="form-control" value="{{ $jadwal->waktu }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
